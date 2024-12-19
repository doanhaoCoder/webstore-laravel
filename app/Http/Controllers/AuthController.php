<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string', // email hoặc name
            'password' => 'required|string',
        ]);

        // Tìm người dùng bằng username (email hoặc name)
        $user = User::where('name', $request->username)
                    ->orWhere('email', $request->username)
                    ->first();

        // Kiểm tra người dùng và mật khẩu
        if ($user && Hash::check($request->password, $user->password)) {
            // Lưu session cho người dùng
            // Session::put('user', $user);
            session(['user' => $user, 'role' => $user->role, 'id' => $user->id]);

            // Chuyển hướng đến dashboard hoặc trang mong muốn
            return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
        }

        // Nếu thông tin đăng nhập không đúng
        return back()->withErrors(['username' => 'Thông tin đăng nhập không hợp lệ.']);
    }

    // Xử lý logout
    public function logout()
    {
        // Xóa session khi người dùng đăng xuất
        Session::forget('user');
        Session::forget('id');
        Session::forget('role');
        
        // Chuyển hướng về trang đăng nhập
        return redirect()->route('login')->with('success', 'Bạn đã đăng xuất thành công.');
    }

    // Hiển thị form đăng ký
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        // Kiểm tra dữ liệu nhập vào
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Tạo người dùng mới
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Đăng nhập người dùng ngay sau khi đăng ký
        Session::put('user', $user);

        return redirect()->route('home')->with('success', 'Đăng ký thành công!');
    }
}
