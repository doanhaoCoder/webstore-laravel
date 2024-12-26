<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    // Hiển thị danh sách đơn hàng cho trang dashboard
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    // Hiển thị chi tiết đơn hàng
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        return view('orders.show', compact('order', 'orderItems'));
    }

    // Cập nhật trạng thái đơn hàng
    public function updateStatus($id, $status)
    {
        $order = Order::findOrFail($id);
        $order->status = $status;
        $order->save();

        return redirect()->route('orders.index');
    }
    
    // Hàm xóa đơn hàng
    public function destroy($id)
    {
        // Tìm đơn hàng theo ID
        $order = Order::findOrFail($id);

        // Xóa đơn hàng
        $order->delete();

        // Quay lại trang danh sách đơn hàng với thông báo thành công
        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được xóa thành công!');
    }

    // Hiển thị tất cả đơn hàng của người dùng hiện tại
    public function userOrders()
{
    // Lấy user_id từ session
    $userId = session('id');
    //  dd(session()->all());
    // Kiểm tra xem user_id có tồn tại trong session không
    if (!$userId) {
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem đơn hàng của bạn.');
    }

    // Lấy tất cả đơn hàng của người dùng từ session
    $orders = Order::where('user_id', $userId)  // Lọc theo user_id lấy từ session
                    ->orderBy('created_at', 'desc')   // Sắp xếp theo ngày tạo đơn hàng mới nhất
                    ->get();

    return view('userOrders.index', compact('orders'));
}

    
}
