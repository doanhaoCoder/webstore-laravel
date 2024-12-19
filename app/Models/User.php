<?php

// app/Models/User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Hàm lấy role của user (Role là một thuộc tính hoặc mô hình khác)
    public function role()
    {
        return $this->belongsTo(Role::class);  // Giả sử Role là một bảng riêng biệt
    }
}




