<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::paginate(4);
        return view('foods.index')->with('foods', $foods);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $foods = Food::where('name', 'like', "%$search%")
                     ->orWhere('description', 'like', "%$search%")
                     ->paginate(4);
        return view('foods.index')->with('foods', $foods);
    }

    public function create()
    {
        $categories = Categorie::all(); // Lấy danh sách danh mục
        return view('foods.create', compact('categories'));
    }
    

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:500',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id', // Thêm category_id
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('food_images', 'public');
        $validatedData['image'] = $imagePath;
    }

    Food::create($validatedData);

    return redirect()->route('foods.index')->with('success', 'Food item created successfully!');
}



    public function edit($id)
    {
        $food = Food::findOrFail($id);
        $categories = Categorie::all();
        return response()->json($food);
    }

    public function update(Request $request, $id)
    {
        $food = Food::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($food->image) {
                Storage::disk('public')->delete($food->image);
            }
            $imagePath = $request->file('image')->store('food_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $food->update($validatedData);
        return redirect()->route('foods.index')->with('success', 'Food item updated successfully!');
    }

    public function destroy($id)
    {
        $food = Food::findOrFail($id);
        if ($food->image) {
            Storage::disk('public')->delete($food->image);
        }
        $food->delete();
        return redirect()->route('foods.index')->with('success', 'Food item deleted successfully!');
    }

    public function show($id)
    {
        $food = Food::findOrFail($id);
        return view('foods.show', compact('food'));
    }
}
