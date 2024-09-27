<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUsMsgs extends Model
{
    use HasFactory;

    protected $table = 'contactus_msgs';
    protected $guard = 'admin';
    protected $fillable = ['id', 'name', 'email', 'message', 'created_at', 'created_by', 'updated_at', 'updated_by'];
}
