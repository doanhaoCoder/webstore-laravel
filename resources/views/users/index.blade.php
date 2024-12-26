<!-- resources/views/dashboard/users/index.blade.php -->

@extends('dashboard.index')

@section('content')
<div class="container">
@if(session('role') === 'admin')

    <h1>Danh sách người dùng</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Thêm người dùng mới</a>
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Role</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Sửa</a>
                    <form action="{{ route('users.delete', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
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
