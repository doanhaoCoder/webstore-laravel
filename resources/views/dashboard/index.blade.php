
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .user-info {
    position: fixed;
    top: 10px;
    right: 10px;
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    z-index: 9999;
    }

    .user-info h4, .user-info p {
        margin: 0;
    }

    .user-info button {
        margin-top: 10px;
    }

/*  */

    .nav {
    padding: 20px 0;
    margin: 0;
    list-style: none;
    }

    .nav-item {
        margin: 10px 0;
    }

    .nav-link {
        display: block;
        padding: 10px 20px;
        font-size: 16px;
        color: #333;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .nav-link:hover {
        background-color: #007bff;
        color: white;
    }

    .nav-link:active {
        background-color: #0056b3;
        color: white;
    }

    .nav-item .nav-link {
        font-weight: 500;
    }

    </style>
</head>
<body>
    <a class="nav-link" href="/" style="font-size:150%; position: fixed; bottom: 20px; right: 20px; background-color: #007bff; color: white; padding: 10px 20px; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); text-decoration: none;">Trang Người Dùng</a>
 
    <div class="user-info">                                            
    @if (session()->has('user'))
    <h4>Chào, {{ session('user')->name }}<br> Quyền: {{ session('user')->role }}</h4>
    <form action="{{ url('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">Logout</button>
    </form>
    @else
    @endif
    
    </div>
    @if(session('role') === 'admin' || session('role') === 'mod')
    <div class="d-flex">
        <!-- Thanh menu bên trái -->
        <div class="bg-light p-3" style="width: 250px; height: 100vh;">


        <h1 >Dashboard</h1>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('categories.index') }}">Danh mục sản phẩm</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('products.index') }}">Sản phẩm</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('orders.index') }}">Hóa đơn</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('contacts.show') }}">Liên hệ</a>
            </li>
            @if(session('role') === 'admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">Người dùng</a>
            </li>
            @else
            @endif
        </ul>
        </div>

        <!-- Phần nội dung -->
        <div class="content p-3" style="flex: 1;">
            <h1 style="text-align: center; color: pink">Welcome to FlowerErdtree</h1>
            @yield('content') 
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    @else
    <h3 style="text-align: center;">Người dùng chỉ xem được orders</h3>
   
    <div class="container">
    <a href="/my-orders" class="btn btn-primary mb-2" style="margin: auto;">Trở lại giỏ hàng</a>
    </div>
    

    @if (session()->has('user'))
    @yield('content') 
    @else
    @endif
    @endif
          
    
</body>
</html>