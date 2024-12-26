<!-- resources/views/dashboard/users/edit.blade.php -->

@extends('dashboard.index')

@section('content')
<div class="container">
@if(session('role') === 'admin')

    <h1>Chỉnh sửa người dùng</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Username</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select class="form-control" id="role" name="role" required>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="mod" {{ $user->role == 'mod' ? 'selected' : '' }}>Mod</option>
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu mới</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Xác nhận mật khẩu mới</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>
        <button type="submit" class="btn btn-warning mt-2">Cập nhật</button>
    </form>
    @else
    @endif
</div>
@endsection
