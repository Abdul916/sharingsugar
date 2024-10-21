<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoChangeLog extends Model
{
    use HasFactory;

    protected $table = 'photo_change_logs';

    protected $fillable = [
        'user_id',
        'photo',
        'type',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
