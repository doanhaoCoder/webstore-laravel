@extends('dashboard.index')

@section('content')
<div class="container">
@if(session('role') === 'admin' || session('role') === 'mod')
    <h1>Sửa danh mục</h1>
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('POST')
        <div class="mb-3">
            <label for="name" class="form-label">Tên danh mục</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description">{{ $category->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>
    @else
    @endif
</div>
@endsection
