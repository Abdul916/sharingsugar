<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipLogs extends Model
{
    use HasFactory;

    protected $table = 'membership_logs';
    protected $guard = 'admin';
    protected $fillable = ['id', 'user_id', 'membership_type', 'membership_price', 'membership_start', 'membership_end', 'status', 'created_at', 'status', 'updated_at'];
}
