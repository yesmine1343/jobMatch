<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthController extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];
}
