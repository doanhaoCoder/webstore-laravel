@extends('dashboard.index')

@section('content')
<div class="container">
@if(session('role') === 'admin' || session('role') === 'mod')
    <h1>Danh sách danh mục</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Thêm mới</a>
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <!-- Chỉnh sửa -->
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <!-- Xóa -->
                        <a href="{{ route('categories.destroy', $category->id) }}" class="btn btn-danger btn-sm" 
                           onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    @endif
</div>
@endsection
