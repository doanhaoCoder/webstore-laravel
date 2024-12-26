@extends('dashboard.index')

@section('content')
<div class="container">
    <h1>Chi tiết liên hệ</h1>
    <div class="card mt-4">
        <div class="card-header">
            Thông tin liên hệ
        </div>
        <div class="card-body">
            <!-- <p><strong>ID:</strong> {{ $contact->id }}</p> -->
            <p><strong>Tên:</strong> {{ $contact->name }}</p>
            <p><strong>Email:</strong> {{ $contact->email }}</p>
            <p><strong>Số điện thoại:</strong> {{ $contact->phone ?? 'Không có' }}</p>
            <p><strong>Tin nhắn:</strong></p>
            <p>{{ $contact->message }}</p>
            <p><strong>Ngày gửi:</strong> {{ $contact->created_at->format('d/m/Y H:i') }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('contacts.show') }}" class="btn btn-secondary">Quay lại danh sách</a>
        </div>
    </div>
</div>
@endsection
