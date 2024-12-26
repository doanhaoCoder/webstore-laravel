<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .nav-link {
            font-size: 150%;
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-decoration: none;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
<a class="nav-link" href="/cart">Giỏ Hàng</a>

    <div class="container my-5">
        <a href="/" class="btn btn-primary mb-2">Back</a>
        <h1>Sản phẩm trong danh mục: {{ $category->name }}</h1>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                            <form id="add-to-cart-form-{{ $product->id }}" data-product-id="{{ $product->id }}">
                                @csrf
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">Chi tiết</a>
                                <button type="button" class="btn btn-success add-to-cart-button">Thêm vào giỏ</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const addToCartButtons = document.querySelectorAll('.add-to-cart-button');

        addToCartButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                // Gọi API để kiểm tra session
                fetch('/check-session', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.logged_in) {
                        // Người dùng đã đăng nhập, tiến hành thêm vào giỏ hàng
                        const form = this.closest('form');
                        const productId = form.dataset.productId;
                        const csrfToken = form.querySelector('input[name="_token"]').value;

                        fetch(`/cart/add/${productId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({})
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Sản phẩm đã được thêm vào giỏ hàng!');
                                // Cập nhật giao diện giỏ hàng nếu cần
                            } else {
                                alert('Đã xảy ra lỗi, vui lòng thử lại!');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    } else {
                        // Người dùng chưa đăng nhập, chuyển hướng đến trang login
                        alert('Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.');
                        window.location.href = '/login';
                    }
                })
                .catch(error => console.error('Error checking session:', error));
            });
        });
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
