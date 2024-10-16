<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $guard = 'admin';
    protected $fillable = [
        'name',
        'slug',
        'picture',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

}
