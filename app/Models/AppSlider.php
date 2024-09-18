<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSlider extends Model
{
    use HasFactory;
    protected $table = 'app_slider';
    protected $fillable = ['title', 'image', 'status'];

}
