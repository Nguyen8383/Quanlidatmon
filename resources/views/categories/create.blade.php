@extends('layout.app')
@section('title')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm mới danh mục</h1>
       
    </div>
@endsection
@section('content')
    <form action="{{route('category.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label>Tên</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label>Mổ tả</label>
            <input type="text" name="description" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>

    @if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Có lỗi xảy ra!',
            html: `
                <ul style="text-align: left;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
        });
    </script>
@endif

@endsection
