@extends('dashboard.index')

@section('content')
<div class="container">
@if(session('role') === 'admin' || session('role') === 'mod')
    <h1>Danh sách sản phẩm</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Thêm sản phẩm mới</a>
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Mô tả</th>
                <th>Giá</th>
                <th>Ảnh</th>
                <th>Danh mục</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td class="product-description">
                    {{ Str::limit($product->description, 20) }} <!-- Giới hạn mô tả ở 20 ký tự -->
                    @if (strlen($product->description) > 20)
                        <a href="{{ route('products.edit', $product->id) }}" class="read-more">... Xem thêm</a>
                    @endif
                </td>
                <td>{{ number_format($product->price, 0, ',', '.') }} VND</td>
                <td>
                    @if ($product->image)
                        <img src="{{ asset('' . $product->image) }}" alt="{{ $product->name }}" class="product-image" style="max-width: 45px">
                    @else
                        No image
                    @endif
                </td>
                <td>{{ $product->category->name }}</td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Sửa</a>
                    <form action="{{ route('products.delete', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    @endif
</div>

@endsection

@push('styles')
<style>
    .product-image {
        max-width: 100px; /* Đảm bảo ảnh không quá rộng */
        height: auto;
    }

    .product-description {
        max-width: 300px; /* Giới hạn độ rộng cho mô tả */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis; /* Nếu mô tả dài hơn, sẽ hiển thị '...' */
    }

    .product-description a.read-more {
        color: #007bff;
        text-decoration: none;
    }

    .product-description a.read-more:hover {
        text-decoration: underline;
    }
</style>
@endpush
