@extends('dashboard.index') <!-- Kế thừa layout dashboard chung -->

@section('content')
<div class="container">
@if(session('role') === 'admin')

    <h1>Thêm người dùng mới</h1>
    
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Username</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" id="password" name="password" class="form-control" required>
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Xác nhận mật khẩu</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="role">Vai trò</label>
            <select name="role" id="role" class="form-control" required>
                <option value="admin">Admin</option>
                <option value="mod">Mod</option>
                <option value="user">User</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Thêm người dùng</button>
    </form>
    @else
    @endif
</div>
@endsection
