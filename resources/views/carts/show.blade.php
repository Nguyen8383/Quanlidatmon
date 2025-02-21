@extends('layout.app')



@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Chi tiết giỏ hàng</h3>
        </div>
        <div class="card-body">
            <h4><strong>ID:</strong> {{ $cart->id }}</h4>
            <h4><strong>ID Khách Hàng:</strong> {{ $cart->customer_id }}</h4>
            <h4><strong>Ngày tạo:</strong> {{ $cart->created_at }}</h4>
            <h4><strong>Cập nhật lần cuối:</strong> {{ $cart->updated_at }}</h4>
        </div>
        <div class="card-footer">
            <a href="{{ route('carts.index') }}" class="btn btn-primary">Quay lại danh sách</a>
        </div>
    </div>
@endsection
