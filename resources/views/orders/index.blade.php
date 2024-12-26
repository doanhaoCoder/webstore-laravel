@extends('dashboard.index')

@section('content')
<div class="container">
@if(session('role') === 'admin' || session('role') === 'mod')

    <h2>Danh sách đơn hàng</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Khách hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ number_format($order->total, 0, ',', '.') }} VNĐ</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info">Xem chi tiết</a>
                        <form action="{{ route('orders.updateStatus', [$order->id, 'Đang giao hàng']) }}" method="POST" style="display: inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-warning">Đang giao hàng</button>
                        </form>
                        <form action="{{ route('orders.updateStatus', [$order->id, 'Đã nhận hàng']) }}" method="POST" style="display: inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-success">Đã giao hàng</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    @endif
</div>
@endsection
