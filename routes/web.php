<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\DashboardController;
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Các route cho các mục trong dashboard
Route::get('/dashboard/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/dashboard/products', [ProductController::class, 'index'])->name('products.index');

use App\Http\Controllers\CategoryController;

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('create', [CategoryController::class, 'create'])->name('create');
    Route::post('store', [CategoryController::class, 'store'])->name('store');
    Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');  // Chức năng sửa
    Route::post('update/{id}', [CategoryController::class, 'update'])->name('update');  // Chức năng update
    Route::get('delete/{id}', [CategoryController::class, 'destroy'])->name('destroy');  // Chức năng xóa
});

use App\Http\Controllers\ProductController;

Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('products', [ProductController::class, 'store'])->name('products.store');
Route::get('products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
Route::put('products/update/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('products/delete/{id}', [ProductController::class, 'destroy'])->name('products.delete');

use App\Http\Controllers\UserController;

Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::get('users/create', [UserController::class, 'create'])->name('users.create');
Route::post('users', [UserController::class, 'store'])->name('users.store');
Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::put('users/update/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
Route::get('users/detail/{id}', [UserController::class, 'detail'])->name('users.detail');

use App\Http\Controllers\AuthController;

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('guest')->group(function() {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Route cho chi tiết sản phẩm
Route::get('/products/{id}', [HomeController::class, 'show'])->name('products.show');


use App\Http\Controllers\CartController;

// Route giỏ hàng
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');


use Illuminate\Http\Request;

Route::post('/cart/add/{id}', function (Request $request, $id) {
    $product = App\Models\Product::findOrFail($id);
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
    } else {
        $cart[$id] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'image' => $product->image, // Thêm thông tin hình ảnh sản phẩm
        ];
    }

    session()->put('cart', $cart);

    return response()->json(['success' => true]);
})->name('cart.add');

use App\Http\Controllers\CheckoutController;

Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout');

use App\Http\Controllers\OrderController;

Route::prefix('orders')->group(function() {
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('orders/{id}/{status}', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::delete('orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy'); // Route xóa hóa đơn
});

Route::get('my-orders', [OrderController::class, 'userOrders'])->name('user.orders.index');

Route::get('/home/products', [HomeController::class, 'products'])->name('home.products');

use Illuminate\Support\Facades\Auth;


Route::get('/check-session', function () {
    // Lấy user_id từ session
    $userId = Session::get('id');
    // Trả về JSON phản hồi, cho biết người dùng có đăng nhập hay không
    return response()->json([
        'logged_in' => $userId ? true : false,
        'user_id' => $userId
    ]);
});

use App\Models\Category;
use App\Models\Product;
Route::get('/category/{category_id}', function ($category_id) {
    // Lấy danh mục theo category_id
    $category = Category::findOrFail($category_id);

    // Lấy các sản phẩm có category_id trùng với category_id của danh mục
    $products = Product::where('category_id', $category_id)->get();

    // Lấy tất cả các danh mục để hiển thị trong dropdown
    $categories = Category::all();

    // Trả về view và truyền danh mục và sản phẩm vào view
    return view('category', compact('category', 'products', 'categories'));
});

use App\Http\Controllers\ContactController;

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/dashboard/contacts', [ContactController::class, 'show'])->name('contacts.show');
Route::get('/dashboard/contacts/{id}', [ContactController::class, 'detail'])->name('contacts.detail');
Route::delete('/dashboard/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');

use App\Http\Controllers\ProfileController;

// Route không có middleware 'auth'
Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
