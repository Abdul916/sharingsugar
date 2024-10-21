<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileChangeLog extends Model
{
    use HasFactory;

    protected $table = 'profile_change_logs';

    protected $fillable = [
        'user_id',
        'updated_data',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
