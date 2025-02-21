@extends('layout.app')

@section('title',)

@section('content')
<div class="container">
    <h1 class="mt-4">Danh sách đơn hàng</h1>
    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Thêm đơn hàng</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Khách hàng</th>
                <th>Nhân viên</th>
                <th>Tổng giá</th>
                <th>Giảm giá</th>
                <th>Trạng thái</th>
                <th>Thời gian tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer_id }}</td>
                    <td>{{ $order->employee_id ?? 'N/A' }}</td>
                    <td>{{ number_format($order->total_price, 2) }} VNĐ</td>
                    <td>{{ $order->discount_id ?? 'Không có' }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Xem</a>
                        <a href="{{ route('order.edit', $order->id) }}" class="btn btn-warning">Chỉnh sửa</a>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $orders->links() }}
</div>
@endsection
