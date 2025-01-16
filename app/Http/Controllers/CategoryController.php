<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categorie::paginate(perPage: 4);
        return view('categories.index')->with('categories', $categories);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $categories = Categorie::where(function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        })->paginate(4);
        return view('categories.index')->with('categories', $categories);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:500'
    ], [
        'name.required' => 'Trường tên không được để trống.',
        'name.string' => 'Trường tên phải là chuỗi ký tự.',
        'name.max' => 'Trường tên không được vượt quá 255 ký tự.',
        'description.required' => 'Trường mô tả không được để trống.',
        'description.string' => 'Trường mô tả phải là chuỗi ký tự.',
        'description.max' => 'Trường mô tả không được vượt quá 500 ký tự.',
    ]);

    // Nếu dữ liệu hợp lệ, lưu vào cơ sở dữ liệu
    Categorie::create($validatedData);

    // Chuyển hướng với thông báo thành công
    return redirect()->route('category.index')->with('success', 'Category created successfully!');
}

}
