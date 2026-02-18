<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    // Use the same users table
    protected $table = 'users';

    // Fillable fields
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',      // you can use role to distinguish admin
    ];

    // Hidden fields
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casts
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Scope to select only admins
     */
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }
}
