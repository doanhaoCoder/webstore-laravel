@extends('dashboard.index')

@section('content')
<div class="container">
@if(session('role') === 'admin' || session('role') === 'mod')
    <h1>Thêm mới danh mục</h1>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên danh mục</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
    </form>
    @else
    @endif
</div>
@endsection
