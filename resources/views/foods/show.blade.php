@extends('layout.app')



@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Chi tiết danh mục</h3>
        </div>
        <div class="card-body">
            <h4><strong>ID:</strong> {{ $food->id }}</h4>
            <h4><strong>Tên:</strong> {{ $food->name }}</h4>
            <h4><strong>Mô tả:</strong></h4>
            <p>{{ $food->description }}</p>
            <h4><strong>Giá:</strong> {{ $food->price }}</h4>
            <h4><strong>Categoryn Id:</strong> {{ $food->category_id }}</h4>
            <h4><strong>Ngày tạo:</strong> {{ $food->created_at }}</h4>
            <h4><strong>Cập nhật lần cuối:</strong> {{ $food->updated_at }}</h4>
        </div>
        <div class="card-footer">
            <a href="{{ route('foods.index') }}" class="btn btn-primary">Quay lại danh sách</a>
        </div>
    </div>
@endsection
