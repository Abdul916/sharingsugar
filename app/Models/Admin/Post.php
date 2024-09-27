<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $guard = 'admin';
    protected $fillable = [
        'title',
        'description',
        'slug',
        'thumbnail',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

    public function getNextAttribute(){
        return static::where('id', '>', $this->id)->orderBy('id','asc')->first();
    }
    public  function getPreviousAttribute(){
        return static::where('id', '<', $this->id)->orderBy('id','desc')->first();
    }
}
