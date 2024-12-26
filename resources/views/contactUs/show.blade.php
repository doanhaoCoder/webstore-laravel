@extends('dashboard.index')

@section('content')
<div class="container">
    @if(session('role') === 'admin' || session('role') === 'mod')
        <h1>Danh sách liên hệ</h1>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <!-- <th>ID</th> -->
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Tin nhắn</th>
                    <th>Ngày gửi</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <!-- <td>{{ $contact->id }}</td> -->
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>{{ Str::limit($contact->message, 50) }}</td>
                        <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <!-- Xem chi tiết -->
                            <a href="{{ route('contacts.detail', $contact->id) }}" class="btn btn-info btn-sm">Chi tiết</a>
                            <!-- Xóa -->
                            <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" 
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-danger">Bạn không có quyền truy cập trang này.</div>
    @endif
</div>
@endsection
