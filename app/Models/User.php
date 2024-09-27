<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';

    protected $fillable = [
        'unique_id',
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'iam',
        'interestedin',
        'dob',
        'age',
        'height',
        'weight',
        'body_type',
        'child',
        'city',
        'state',
        'zipcode',
        'country',
        'address',
        'timezone',
        'gender',
        'about_me',
        'latitude',
        'longitude',
        'profile_image',
        'last_login',
        'membership_type',
        'membership_price',
        'membership_start',
        'membership_end',
        'membership_status',
        'marital_status',
        'privacy_status',
        'verify_status',
        'financial_support',
        'status',
        'show_last_login',
        'block_male_msg',
        'block_female_msg',
        'block_trans_msg',
        'block_all_email',
        'block_money_making_opp_email',
        'block_local_event_meet_up_email',
        'block_like_favorite_email',
        'created_at',
        'updated_at'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
