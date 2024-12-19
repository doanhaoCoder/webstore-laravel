<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        // dd(session()->all());
        // dd($userId);  // Debug để xem giá trị user_id trong session
        
        // Lấy user_id từ session
        $userId = session('id');
        // Nếu không có user_id trong session, có thể yêu cầu người dùng đăng nhập
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thực hiện thanh toán.');
        }

        // Lưu đơn hàng, thêm user_id lấy từ session
        $order = Order::create([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'total' => array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)),
            'user_id' => $userId,  // Lưu user_id từ session
        ]);

        // Lưu các sản phẩm trong đơn hàng
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        // Xóa giỏ hàng
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Đơn hàng của bạn đã được xử lý thành công!');
    }
}
