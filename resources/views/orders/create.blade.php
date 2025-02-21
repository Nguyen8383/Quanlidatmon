@extends('layout.app')
@section('content')
<form action="{{ route('orders.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="customer_id">Khách hàng</label>
        <input type="number" name="customer_id" id="customer_id" class="form-control" value="{{ old('customer_id') }}">
        @if ($errors->has('customer_id'))
            <div class="alert alert-danger">{{ $errors->first('customer_id') }}</div>
        @endif
    </div>

    <div class="form-group">
        <label for="employee_id">Nhân viên</label>
        <input type="number" name="employee_id" id="employee_id" class="form-control" value="{{ old('employee_id') }}">
        @if ($errors->has('employee_id'))
            <div class="alert alert-danger">{{ $errors->first('employee_id') }}</div>
        @endif
    </div>

    <div class="form-group">
        <label for="total_price">Tổng giá</label>
        <input type="number" step="0.01" name="total_price" id="total_price" class="form-control" value="{{ old('total_price') }}">
        @if ($errors->has('total_price'))
            <div class="alert alert-danger">{{ $errors->first('total_price') }}</div>
        @endif
    </div>

    <div class="form-group">
        <label for="discount_id">Mã giảm giá</label>
        <input type="number" name="discount_id" id="discount_id" class="form-control" value="{{ old('discount_id') }}">
        @if ($errors->has('discount_id'))
            <div class="alert alert-danger">{{ $errors->first('discount_id') }}</div>
        @endif
    </div>

    <div class="form-group">
        <label for="status">Trạng thái</label>
        <select name="status" id="status" class="form-control">
            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
            <option value="processed" {{ old('status') == 'processed' ? 'selected' : '' }}>Đang xử lý</option>
            <option value="shipped" {{ old('status') == 'shipped' ? 'selected' : '' }}>Đã giao hàng</option>
            <option value="complete" {{ old('status') == 'complete' ? 'selected' : '' }}>Hoàn tất</option>
            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
        </select>
        @if ($errors->has('status'))
            <div class="alert alert-danger">{{ $errors->first('status') }}</div>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Tạo đơn hàng</button>
</form>
@endsection