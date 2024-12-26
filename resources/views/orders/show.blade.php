@extends('dashboard.index')

@section('content')
<div class="container">


    <h2>Chi tiết đơn hàng</h2>
    <div class="card">
        <div class="card-body">
            <h5>Thông tin khách hàng</h5>
            <p><strong>Tên khách hàng:</strong> {{ $order->customer_name }}</p>
            <p><strong>Email:</strong> {{ $order->customer_email }}</p>
            <p><strong>Điện thoại:</strong> {{ $order->customer_phone }}</p>
            <p><strong>Địa chỉ:</strong> {{ $order->customer_address }}</p>

            <h5>Danh sách sản phẩm</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderItems as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} VNĐ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h5>Tổng tiền: {{ number_format($order->total, 0, ',', '.') }} VNĐ</h5>

            <h5>Trạng thái: {{ ucfirst($order->status) }}</h5>
        </div>
    </div>
    @if(session('role') === 'admin' || session('role') === 'mod')
    <!-- Nút xóa đơn hàng -->
    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?');">
        @csrf
        @method('DELETE') <!-- Xác định phương thức DELETE -->
        <button type="submit" class="btn btn-danger mt-2">Xóa đơn hàng</button>
    </form>
    @else
    @endif
    
</div>
@endsection
