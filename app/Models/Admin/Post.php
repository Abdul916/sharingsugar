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
        'category_id',
        'description',
        'slug',
        'thumbnail',
        'status',
        'keywords',
        'short_description',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];


    public function PostCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getNextAttribute(){
        return static::where('id', '>', $this->id)->orderBy('id','asc')->first();
    }
    public  function getPreviousAttribute(){
        return static::where('id', '<', $this->id)->orderBy('id','desc')->first();
    }
}
