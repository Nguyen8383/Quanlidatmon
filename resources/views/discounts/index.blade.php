@extends('layout.app')

@section('content')
<div class="container">
    <h2>Danh sách mã giảm giá</h2>
    <a href="{{ route('discount.create') }}" class="btn btn-primary mb-3">Tạo mã mới</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Mã</th>
                <th>Phần trăm</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($discounts as $discount)
            <tr>
                <td>{{ $discount->id }}</td>
                <td>{{ $discount->code }}</td>
                <td>{{ $discount->percentage }}%</td>
                <td>{{ $discount->start_date }}</td>
                <td>{{ $discount->end_date }}</td>
                <td>
                    <a href="{{ route('discount.show', $discount->id) }}" class="btn btn-info">Xem</a>
                    <form action="{{ route('discount.destroy', $discount->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
