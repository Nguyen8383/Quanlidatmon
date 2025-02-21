<?php

namespace App\Http\Controllers;

use App\Models\Categorie; // Sử dụng model Categorie để làm việc với bảng 'categories' trong cơ sở dữ liệu.
use Illuminate\Http\Request; // Sử dụng lớp Request để xử lý dữ liệu từ người dùng.

class CategoryController extends Controller
{
    // Phương thức hiển thị danh sách categories.
    public function index()
    {
        // Lấy dữ liệu từ bảng 'categories' và phân trang (4 mục mỗi trang).
        $categories = Categorie::paginate(perPage: 4);

        // Trả về view 'categories.index' với danh sách categories.
        return view('categories.index')->with('categories', $categories);
    }

    // Phương thức tìm kiếm categories dựa trên từ khóa.
    public function search(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ request.
        $search = $request->input('search');

        // Tìm kiếm các category có tên hoặc mô tả chứa từ khóa (không phân biệt chữ hoa/thường).
        $categories = Categorie::where(function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%') // Tìm theo tên.
                ->orWhere('description', 'like', '%' . $search . '%'); // Hoặc theo mô tả.
        })->paginate(4); // Phân trang kết quả tìm kiếm.

        // Trả về view 'categories.index' với kết quả tìm kiếm.
        return view('categories.index')->with('categories', $categories);
    }

    // Phương thức hiển thị trang thêm mới category.
    public function create()
    {
        // Trả về view 'categories.create'.
        return view('categories.create');
    }

    // Phương thức lưu category mới vào cơ sở dữ liệu.
    public function store(Request $request)
    {
        // Xác thực dữ liệu từ request.
        $validatedData = $request->validate([
            'name' => 'required|string|max:255', // Trường name là bắt buộc, kiểu chuỗi, tối đa 255 ký tự.
            'description' => 'required|string|max:500' // Trường description là bắt buộc, kiểu chuỗi, tối đa 500 ký tự.
        ], [
            'name.required' => 'Trường tên không được để trống.', // Thông báo lỗi nếu trường name không được nhập.
            'name.string' => 'Trường tên phải là chuỗi ký tự.', // Thông báo lỗi nếu name không phải chuỗi.
            'name.max' => 'Trường tên không được vượt quá 255 ký tự.', // Lỗi nếu name quá dài.
            'description.required' => 'Trường mô tả không được để trống.', // Thông báo lỗi nếu description không được nhập.
            'description.string' => 'Trường mô tả phải là chuỗi ký tự.', // Lỗi nếu description không phải chuỗi.
            'description.max' => 'Trường mô tả không được vượt quá 500 ký tự.', // Lỗi nếu description quá dài.
        ]);

        // Nếu dữ liệu hợp lệ, lưu vào bảng 'categories'.
        Categorie::create($validatedData);

        // Chuyển hướng về danh sách categories với thông báo thành công.
        return redirect()->route('category.index')->with('success', 'Category created successfully!');
    }

    // Phương thức hiển thị thông tin của category trong modal để chỉnh sửa.
    public function edit($id)
    {
        // Tìm category theo id. Nếu không tồn tại sẽ trả về lỗi 404.
        $category = Categorie::findOrFail($id);

        // Trả về dữ liệu category dưới dạng JSON (phục vụ cho JavaScript trong giao diện).
        return response()->json($category);
    }

    // Phương thức xử lý cập nhật category.
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu từ request.
        $validatedData = $request->validate([
            'name' => 'required|string|max:255', // Xác thực trường name.
            'description' => 'required|string|max:500' // Xác thực trường description.
        ], [
            'name.required' => 'Trường tên không được để trống.',
            'name.string' => 'Trường tên phải là chuỗi ký tự.',
            'name.max' => 'Trường tên không được vượt quá 255 ký tự.',
            'description.required' => 'Trường mô tả không được để trống.',
            'description.string' => 'Trường mô tả phải là chuỗi ký tự.',
            'description.max' => 'Trường mô tả không được vượt quá 500 ký tự.',
        ]);

        // Tìm category cần cập nhật dựa trên id.
        $category = Categorie::findOrFail($id);

        // Cập nhật dữ liệu mới vào bảng 'categories'.
        $category->update($validatedData);

        // Chuyển hướng về danh sách categories với thông báo thành công.
        return redirect()->route('category.index')->with('success', 'Category updated successfully!');
    }
    public function destroy($id)
    {
        // Tìm category theo ID, nếu không tìm thấy sẽ trả về lỗi 404
        $category = Categorie::findOrFail($id);

        // Xóa category
        $category->delete();

        // Chuyển hướng lại trang danh sách với thông báo thành công
        return redirect()->route('category.index')->with('success', 'Category deleted successfully!');
    }
    public function show($id)
    {
        // Tìm danh mục theo ID
        $category = Categorie::findOrFail($id);

        // Trả về view hiển thị chi tiết danh mục
        return view('categories.show', compact('category'));
    }
}
