<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all();
        return view('discounts.index', compact('discounts'));
    }

    public function create()
    {
        return view('discounts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:discounts,code',
            'percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Discount::create($request->all());

        return redirect()->route('discount.index')->with('success', 'Mã giảm giá đã được tạo thành công.');
    }

    public function show($id)
    {
        $discount = Discount::findOrFail($id);
        return view('discounts.show', compact('discount'));
    }

    public function update(Request $request, $id)
    {
        $discount = Discount::findOrFail($id);

        $request->validate([
            'code' => 'required|string|unique:discounts,code,' . $id,
            'percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $discount->update($request->all());

        return redirect()->route('discount.index')->with('success', 'Mã giảm giá đã được cập nhật.');
    }

    public function destroy($id)
    {
        Discount::findOrFail($id)->delete();
        return redirect()->route('discount.index')->with('success', 'Mã giảm giá đã bị xóa.');
    }
}
