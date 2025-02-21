<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Hiển thị danh sách đơn hàng
    public function index()
    {
        $orders = Order::paginate(10);
        return view('orders.index', compact('orders'));
    }

    // Hiển thị form tạo đơn hàng mới
    public function create()
    {
        return view('orders.create');
    }

    // Xử lý lưu đơn hàng mới vào database
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validatedData = $request->validate([
            'customer_id' => 'required|integer|exists:customers,id',
            'employee_id' => 'nullable|integer|exists:employees,id',
            'total_price' => 'required|numeric|min:0',
            'discount_id' => 'nullable|integer|exists:discounts,id',
            'status' => 'required|in:pending,processed,shipped,complete,cancelled',
        ], [
            'customer_id.required' => 'Khách hàng không được để trống.',
            'customer_id.integer' => 'Khách hàng phải là số nguyên.',
            'customer_id.exists' => 'Khách hàng không hợp lệ.',
    
            'employee_id.integer' => 'Nhân viên phải là số nguyên.',
            'employee_id.exists' => 'Nhân viên không tồn tại.',
    
            'total_price.required' => 'Tổng giá không được để trống.',
            'total_price.numeric' => 'Tổng giá phải là số.',
            'total_price.min' => 'Tổng giá không được nhỏ hơn 0.',
    
            'discount_id.integer' => 'Giảm giá phải là số nguyên.',
            'discount_id.exists' => 'Mã giảm giá không hợp lệ.',
    
            'status.required' => 'Trạng thái đơn hàng không được để trống.',
            'status.in' => 'Trạng thái đơn hàng không hợp lệ.',
        ]);
    
        // Tạo đơn hàng mới
        Order::create($validatedData);
    
        // Chuyển hướng về danh sách đơn hàng với thông báo thành công
        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được tạo thành công!');
    }
    

    // Hiển thị thông tin chi tiết một đơn hàng
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.show', compact('order'));
    }

    // Cập nhật thông tin đơn hàng
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validatedData = $request->validate([
            'customer_id' => 'required|integer',
            'employee_id' => 'nullable|integer',
            'total_price' => 'required|numeric|min:0',
            'discount_id' => 'nullable|integer',
            'status' => 'required|string|max:50',
        ]);

        $order->update($validatedData);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully!');
    }

    // Xóa đơn hàng
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully!');
    }
    public function edit($id)
{
    $order = Order::findOrFail($id); // Tìm đơn hàng theo ID
    return view('orders.index', compact('order')); // Trả về view edit
}
}
