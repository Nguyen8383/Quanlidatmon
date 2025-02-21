<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    // Phương thức hiển thị danh sách carts.
    public function index()
    {
        // Lấy dữ liệu từ bảng 'carts' và phân trang (4 mục mỗi trang).
        $carts = Cart::paginate(4);

        // Trả về view 'carts.index' với danh sách carts.
        return view('carts.index', compact('carts'));
    }


    // Phương thức tìm kiếm carts dựa trên từ khóa.
    public function search(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ request.
        $search = $request->input('search');

        // Tìm kiếm các cart có tên hoặc mô tả chứa từ khóa (không phân biệt chữ hoa/thường).
        $carts = Cart::where(function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%') // Tìm theo tên.
                ->orWhere('description', 'like', '%' . $search . '%'); // Hoặc theo mô tả.
        })->paginate(4); // Phân trang kết quả tìm kiếm.

        // Trả về view 'carts.index' với kết quả tìm kiếm.
        return view('carts.index')->with('carts', $carts);
    }

    // Phương thức hiển thị trang thêm mới cart.
    public function create()
    {
        // Trả về view 'carts.create'.
        return view('carts.create');
    }

    // Phương thức lưu cart mới vào cơ sở dữ liệu.
    public function store(Request $request)
    {
        // Xác thực dữ liệu từ request.
        $validatedData = $request->validate([
            'customer_id' => 'required|string|max:255', // Trường customer_id là bắt buộc, kiểu chuỗi, tối đa 255 ký tự.
        ], [
            'customer_id.required' => 'Trường customer_id không được để trống.',
            'customer_id.string' => 'Trường customer_id phải là chuỗi ký tự.',
            'customer_id.max' => 'Trường customer_id không được vượt quá 255 ký tự.',
        ]);

        // Nếu dữ liệu hợp lệ, lưu vào bảng 'carts'.
        Cart::create($validatedData);

        // Chuyển hướng về danh sách carts với thông báo thành công.
        return redirect()->route('carts.index')->with('success', 'Cart created successfully!');
    }

    // Phương thức xóa cart.
    public function destroy($id)
    {
        // Tìm cart theo ID, nếu không tìm thấy sẽ trả về lỗi 404
        $cart = Cart::findOrFail($id);

        // Xóa cart
        $cart->delete();

        // Chuyển hướng lại trang danh sách với thông báo thành công
        return redirect()->route('carts.index')->with('success', 'Cart deleted successfully!');
    }

    // Phương thức hiển thị chi tiết cart.
    public function show($id)
    {
        // Tìm cart theo ID
        $cart = Cart::findOrFail($id);

        // Trả về view hiển thị chi tiết cart
        return view('carts.show', compact('cart'));
    }
}
