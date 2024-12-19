<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Lấy user_id từ session
        $userId = session('id');
        // Nếu không có user_id trong session, có thể yêu cầu người dùng đăng nhập
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thực hiện thanh toán.');
        }
        return view('dashboard.index');
    }
}
