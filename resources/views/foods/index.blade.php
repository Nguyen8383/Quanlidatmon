@extends('layout.app') <!-- Kế thừa layout chính của ứng dụng. Tất cả các section bên trong sẽ được chèn vào layout này. -->
@section('title')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách danh mục</h1> <!-- Tiêu đề trang -->
        <a href="{{ route('foods.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Create
        </a> <!-- Nút tạo mới danh mục, điều hướng đến trang tạo mới category -->
    </div>
@endsection

@section('search')
    <!-- Form tìm kiếm category -->
    <form action="{{ route('foods.search') }}"
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2"> <!-- Input để nhập từ khóa tìm kiếm -->
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i> <!-- Nút tìm kiếm -->
                </button>
            </div>
        </div>
    </form>
@endsection

@section('content')
    <!-- Table hiển thị danh sách category -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên</th>
                <th scope="col">Mô tả</th>
                <th scope="col">Price</th>
                <th scope="col">Category_id</th>
                <th scope="col">Ngày tạo</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($foods as $food)
                <!-- Lặp qua tất cả categories -->
                <tr>
                    <th scope="row">{{ $food->id }}</th>
                    <th>{{ $food->name }}</th>
                    <th>{{ \Illuminate\Support\Str::limit($food->description, 60, '...') }}</th> <!-- Mô tả rút gọn -->
                    <th>{{ $food->price }}</th>
                    <th>{{ $food->category_id }}</th>
                    <th>{{ $food->created_at }}</th>
                    <th>
                        <!-- Nút Edit với dữ liệu liên quan đến category -->
                        <button type="button" class="btn btn-primary btn-sm editBtn" data-id="{{ $food->id }}"
                            data-name="{{ $food->name }}" data-description="{{ $food->description }}" data-price ="{{$food->price}}">
                            Edit
                        </button>
                        <form action="{{ route('foods.destroy', $food->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>

                        <a href="{{ route('foods.show', $food->id) }}" class="btn btn-info btn-sm">Show</a>


                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit food</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        @csrf <!-- CSRF token để bảo vệ từ các cuộc tấn công -->
                        @method('PUT') <!-- Phương thức PUT để cập nhật -->
                        <div class="mb-3">
                            <label for="editName" class="form-label">Food Name</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                            <!-- Trường nhập tên danh mục -->
                        </div>
                        <div class="mb-3">
                            <label for="editPrice" class="form-label">Food price</label>
                            <input type="number" class="form-control" id="editPrice" name="price" required step="0.01">
                            <!-- Trường nhập tên danh mục -->
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editDescription" name="description" rows="3" required></textarea> <!-- Trường mô tả -->
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button> <!-- Nút lưu thay đổi -->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Hiển thị phân trang -->
    <div class="d-flex justify-content-center">
        {{ $foods->links() }}
    </div>

    <!-- Thông báo thành công -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session('success') }}',
                < !--Lấy thông báo từ session-- >
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.editBtn');
            const editModal = new bootstrap.Modal(document.getElementById('editModal'));
            const editForm = document.getElementById('editForm');
            const editName = document.getElementById('editName');
            const editPrice = document.getElementById('editPrice');
            const editDescription = document.getElementById('editDescription');

            // Lặp qua tất cả các nút Edit
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = button.getAttribute('data-id'); // Lấy ID từ thuộc tính data-id
                    const name = button.getAttribute('data-name'); // Lấy tên từ data-name
                    const price = button.getAttribute('data-price'); 
                    const description = button.getAttribute(
                    'data-description'); // Lấy mô tả từ data-description

                    // Điền dữ liệu vào form modal
                    editName.value = name;
                    editPrice.value = price;
                    editDescription.value = description;

                    // Cập nhật action của form với URL chứa ID category
                    editForm.action = `/food/${id}`;

                    // Hiển thị modal
                    editModal.show();
                });
            });
        });
    </script>
@endsection
