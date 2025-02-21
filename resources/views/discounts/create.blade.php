@extends('layout.app')

@section('content')
<div class="container">
    <h2>Tạo mã giảm giá mới</h2>
    <form action="{{ route('discount.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="code">Mã giảm giá</label>
            <input type="text" name="code" class="form-control" value="{{ old('code') }}">
            @error('code') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="percentage">Phần trăm</label>
            <input type="number" name="percentage" class="form-control" value="{{ old('percentage') }}" min="0" max="100">
            @error('percentage') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="start_date">Ngày bắt đầu</label>
            <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}">
            @error('start_date') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="end_date">Ngày kết thúc</label>
            <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}">
            @error('end_date') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Tạo</button>
    </form>
</div>
@endsection
