<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $table = 'zones';

    protected $fillable = ['name', 'coordinates'];
    protected $casts = [
        'coordinates' => 'array',
    ];

//     public function provider()
//     {
//         return $this->belongsTo(User::class, 'provider_id');
//     }
}
