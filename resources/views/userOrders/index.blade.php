<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng của tôi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Đơn hàng của tôi</h1>
        <a href="/" class="btn btn-primary mb-2">Back</a>

        @if ($orders->isEmpty())
            <p class="text-center">Bạn chưa có đơn hàng nào.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tình trạng</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @switch($order->status)
                                    @case('Đang duyệt')
                                        Đang duyệt
                                        @break
                                    @case('Đang giao hàng')
                                        Đang giao
                                        @break
                                    @case('Đã nhận hàng')
                                        Đã giao
                                        @break
                                    @default
                                        Chưa xác định
                                @endswitch
                            </td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info">Xem chi tiết</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
