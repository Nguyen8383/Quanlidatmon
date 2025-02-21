@extends('layout.app')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="container">
    <h1 class="mt-4">Chi tiết đơn hàng #{{ $order->id }}</h1>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td>{{ $order->id }}</td>
        </tr>
        <tr>
            <th>Khách hàng ID</th>
            <td>{{ $order->customer_id }}</td>
        </tr>
        <tr>
            <th>Nhân viên ID</th>
            <td>{{ $order->employee_id ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Tổng giá</th>
            <td>{{ number_format($order->total_price, 2) }} VNĐ</td>
        </tr>
        <tr>
            <th>Mã giảm giá</th>
            <td>{{ $order->discount_id ?? 'Không có' }}</td>
        </tr>
        <tr>
            <th>Trạng thái</th>
            <td>{{ $order->status }}</td>
        </tr>
        <tr>
            <th>Thời gian tạo</th>
            <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
        </tr>
    </table>

    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Quay lại</a>
</div>
@endsection
