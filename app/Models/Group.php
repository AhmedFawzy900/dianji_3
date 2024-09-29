<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'user_ids'];

    // Optionally, you can cast the user_ids as an array to handle them easily
    protected $casts = [
        'user_ids' => 'array',
    ];

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class,'coupon_user', 'user_id', 'coupon_id');
    } 
    
}
