@extends('layout.app')

@section('title')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm mới thức ăn</h1>
    </div>
@endsection


    <form action="{{ route('foods.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Tên</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Mô tả</label>
            <textarea name="description" class="form-control" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label>Giá</label>
            <input type="number" name="price" class="form-control" step="0.01" required>
        </div>
        <div class="form-group">
            <label>Danh mục</label>
            <select name="category_id" class="form-control" required>
                <option value="">-- Chọn danh mục --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        

        <div class="form-group">
            <label>Hình ảnh</label>
            <input type="file" name="image" class="form-control-file" accept="image/*" required>
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
