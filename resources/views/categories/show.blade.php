@extends('layout.app')



@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Chi tiết danh mục</h3>
        </div>
        <div class="card-body">
            <h4><strong>ID:</strong> {{ $category->id }}</h4>
            <h4><strong>Tên:</strong> {{ $category->name }}</h4>
            <h4><strong>Mô tả:</strong></h4>
            <p>{{ $category->description }}</p>
            <h4><strong>Ngày tạo:</strong> {{ $category->created_at }}</h4>
            <h4><strong>Cập nhật lần cuối:</strong> {{ $category->updated_at }}</h4>
        </div>
        <div class="card-footer">
            <a href="{{ route('category.index') }}" class="btn btn-primary">Quay lại danh sách</a>
        </div>
    </div>
@endsection
