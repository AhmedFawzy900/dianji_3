<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'orders_notifications';
    protected $fillable = [
        'message',
        'is_read',
        'order_id',
        // 'user_id',
        // 'provider_id',
        // 'user_ids',
        // 'provider_ids'
    ];
    // protected $casts = [
    //     'user_ids' => 'array',
    //     'provider_ids' => 'array',
    // ];
    
}
