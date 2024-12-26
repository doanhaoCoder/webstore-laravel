<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table th, .table td {
            vertical-align: middle;
        }
        .form-control {
            width: 120px;
        }
        .alert {
            margin-bottom: 20px;
        }
        .cart-summary {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .checkout-form {
            margin-top: 30px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .checkout-form label {
            font-weight: bold;
        }
        .checkout-form input,
        .checkout-form textarea {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .checkout-form button {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Giỏ hàng của bạn</h1>
        <a href="/" class="btn btn-primary mb-2">Back</a>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @forelse ($cart as $id => $item)
                    @php $total += $item['price'] * $item['quantity']; @endphp
                    <tr>
                        <td><img 
                            src="{{ asset($item['image'] ?? 'default-image.jpg') }}" 
                            alt="{{ $item['name'] }}" 
                            width="50">
                        </td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                        <td>
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex align-items-center">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control">
                                <button type="submit" class="btn btn-primary ms-2">Cập nhật</button>
                            </form>
                        </td>
                        <td>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} VNĐ</td>
                        <td>
                            <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger">Xóa</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Giỏ hàng trống</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="cart-summary text-end">
            <h4>Tổng cộng: {{ number_format($total, 0, ',', '.') }} VNĐ</h4>
        </div>

        <a href="/" class="btn btn-secondary mt-4">Tiếp tục mua sắm</a>

        <form action="{{ route('checkout') }}" method="POST" class="checkout-form mt-5">
            @csrf
            <h3>Thông tin giao hàng</h3>
            
            <div>
                <label for="name">Họ và tên:</label>
                <input type="text" name="customer_name" id="name" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="customer_email" id="email" required>
            </div>
            <div>
                <label for="phone">Số điện thoại:</label>
                <input type="text" name="customer_phone" id="phone" required>
            </div>
            <div>
                <label for="address">Địa chỉ:</label>
                <textarea name="customer_address" id="address" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Đặt hàng</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
