<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    use HasFactory;

    protected $primaryKey = 'email';

    public $incrementing = false;

    protected $table = 'password_reset_tokens';
    protected $fillable = [
        'email',
        'token',
        'created_at',
        'updated_at',
        'expired_at'
    ];
}
