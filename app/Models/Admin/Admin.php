<?php
namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'admin_users';
    protected $guard = 'admin';
    protected $fillable = [ 'id', 'username', 'email', 'password', 'type', 'status', 'created_at', 'updated_at' ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}