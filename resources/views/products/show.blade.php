<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm - {{ $product->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<a class="nav-link" href="/cart" style="font-size:150%; position: fixed; bottom: 20px; right: 20px; background-color: #007bff; color: white; padding: 10px 20px; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); text-decoration: none;">Giỏ Hàng</a>

    <div class="container my-5">
        <a href="/" class="btn btn-primary mb-2">Back</a>
        <h1 class="mb-4">{{ $product->name }}</h1>

        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid">
            </div>

            <div class="col-md-6">
                <h3 class="text-primary">{{ number_format($product->price, 0, ',', '.') }} VNĐ</h3>
                <p><strong>Mô tả:</strong></p>
                <p>{{ $product->description }}</p>

                <form id="add-to-cart-form-{{ $product->id }}" data-product-id="{{ $product->id }}">
                    @csrf
                    <button type="button" class="btn btn-primary add-to-cart-button">Thêm vào giỏ hàng</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
</body>

</html>
