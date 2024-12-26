<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show($id)
    {
        // Lấy thông tin user từ bảng users
        $user = User::find($id);

        // Kiểm tra nếu user không tồn tại
        if (!$user) {
            return abort(404, 'User not found');
        }

        // Trả về view profile với dữ liệu user
        return view('profile.show', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return abort(404, 'User not found');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.show', $user->id)->with('success', 'Profile updated successfully');
    }
}
