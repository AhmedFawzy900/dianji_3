<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppVideos extends Model
{
    use HasFactory;
    protected $table = 'app_videos';

    protected $fillable = ['title', 'video', 'status', 'related_page'];
}
