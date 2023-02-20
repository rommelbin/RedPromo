<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
        'password',
        'email'
    ];
    protected $hidden = [
        'password',
    ];

    public static array $registerRules = [
        'name' => ['required', 'max:100'],
        'email' => ['required', 'unique:users,email'],
        'password' => ['required', 'min:6']
    ];

    public static array $loginRules = [
        'email' => ['required', 'exists:users'],
        'password' => ['required']
    ];
}
