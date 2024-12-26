<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>ErdTree</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Favicon -->
    <!-- <link href="{{ asset('img/favicon.ico') }}" rel="icon"> -->
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet"> 
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- {{ asset('') }} -->
    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/foody2.css') }}" rel="stylesheet">
</head>
<body>
@if(session('role') === 'admin' || session('role') === 'mod')
<a class="nav-link" href="/categories" style="font-size:150%; position: fixed; bottom: 20px; right: 20px; background-color: #007bff; color: white; padding: 10px 20px; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); text-decoration: none;">Trang Admin</a>
@else
            @endif
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->
    <!-- Navbar Start -->
    <div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="top-bar row gx-0 align-items-center d-none d-lg-flex">
            <div class="col-lg-6 px-5 text-start">
                <small><i class="fa fa-map-marker-alt me-2"></i>123 Street, New York, USA</small>
                <small class="ms-4"><i class="fa fa-envelope me-2"></i>info@example.com</small>
            </div>
            <div class="col-lg-6 px-5 text-end">
                <small>Follow us:</small>
                <a class="text-body ms-3" href=""><i class="fab fa-facebook-f"></i></a>
                <a class="text-body ms-3" href=""><i class="fab fa-twitter"></i></a>
                <a class="text-body ms-3" href=""><i class="fab fa-linkedin-in"></i></a>
                <a class="text-body ms-3" href=""><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
            <a href="/" class="navbar-brand ms-4 ms-lg-0">
                <h1 class="fw-bold text-primary m-0">Flow<span class="text-secondary">erEr</span>dTree</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="/" class="nav-item nav-link">Home</a>
                    <!-- <a href="/" class="nav-item nav-link">About Us</a> -->
                    <a href="/home/products" class="nav-item nav-link active">Products</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Categories</a>
                        
                        <div class="dropdown-menu m-0">
                        @foreach ($categories as $category)
                            <a href="/category/{{ $category->id }}" class="dropdown-item">{{ $category->name }}</a>
                        @endforeach
                        </div>
                    </div>
                    <a href="/contact" class="nav-item nav-link">Contact Us</a>
                    <a href="/my-orders" class="nav-item nav-link">Orders</a>
                    @if (session()->has('user'))
                    <a href="/profile/{{ session('user')->id }}" class="nav-item nav-link">Profile</a>
                    @else
                    @endif

                </div>
                <div class="d-none d-lg-flex ms-2">
                    <a class="btn-sm-square bg-white rounded-circle ms-3" href="">
                        <small class="fa fa-search text-body"></small>
                    </a>
                    <a class="btn-sm-square bg-white rounded-circle ms-3" href="/cart">
                        <small class="fa fa-shopping-bag text-body"></small>
                    </a>
                    <a class="btn-sm-square bg-white rounded-circle ms-5" href="" style="margin-right: 70px">
                        @if (session()->has('user'))
                        <form action="{{ url('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-info" style="width: 200%">{{ session('user')->name }}<br>Logout</button>
                        </form>
                        @else
                        <a href="/login">Đăng Nhập</a>
                        @endif
                    </a>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h5 class="display-3 mb-3 animated slideInDown">Danh mục sản phẩm</h5>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <!-- <li class="breadcrumb-item"><a class="text-body" href="#">Trang Chủ</a></li> -->
                    <!-- <li class="breadcrumb-item"><a class="text-body" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page">Products</li> -->
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->
<!-- <a class="nav-link" href="/cart">Giỏ Hàng</a> -->

    <div class="container my-5">
        <!-- <a href="/" class="btn btn-primary mb-2">Back</a> -->
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
