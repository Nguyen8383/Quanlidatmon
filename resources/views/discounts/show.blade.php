@extends('layout.app')

@section('content')
<div class="container">
    <h2>Chi tiết mã giảm giá</h2>
    <ul>
        <li><strong>ID:</strong> {{ $discount->id }}</li>
        <li><strong>Mã:</strong> {{ $discount->code }}</li>
        <li><strong>Phần trăm:</strong> {{ $discount->percentage }}%</li>
        <li><strong>Ngày bắt đầu:</strong> {{ $discount->start_date }}</li>
        <li><strong>Ngày kết thúc:</strong> {{ $discount->end_date }}</li>
    </ul>
    <a href="{{ route('discount.index') }}" class="btn btn-secondary">Quay lại</a>
</div>
@endsection
