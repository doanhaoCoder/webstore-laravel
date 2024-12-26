@extends('dashboard.index')

@section('content')
<div class="container">
@if(session('role') === 'admin')

    <h1>Thông tin người dùng</h1>
    <div class="form-group">
        <label for="id">ID</label>
        <input type="text" class="form-control" id="id" name="id" value="{{ $user->id }}" readonly>
    </div>
    <div class="form-group">
        <label for="name">Username</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" readonly>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
    </div>
    <div class="form-group">
        <label for="username">Full name</label>
        <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" readonly>
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" readonly>
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}" readonly>
    </div>
    <!-- <div class="form-group">
        <label for="email_verified_at">Email Verified At</label>
        <input type="text" class="form-control" id="email_verified_at" name="email_verified_at" value="{{ $user->email_verified_at }}" readonly>
    </div> -->
    <div class="form-group">
        <label for="role">Role</label>
        <input type="text" class="form-control" id="role" name="role" value="{{ $user->role }}" readonly>
    </div>
    <div class="form-group">
        <label for="created_at">Ngày tạo</label>
        <input type="text" class="form-control" id="created_at" name="created_at" value="{{ $user->created_at }}" readonly>
    </div>
    <div class="form-group">
        <label for="updated_at">Ngày cập nhật</label>
        <input type="text" class="form-control" id="updated_at" name="updated_at" value="{{ $user->updated_at }}" readonly>
    </div>
    <a href="{{ route('users.index') }}" class="btn btn-primary mt-3">Quay lại</a>
    @else
    @endif
</div>
@endsection
