<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Category extends BaseModel implements HasMedia 
{
    use HasFactory,HasRoles,InteractsWithMedia,SoftDeletes;
    protected $table = 'categories';
    protected $fillable = [
        'name', 'description', 'is_featured', 'status' , 'color' , 'zones' , 'image' , 'cover_image' , 'commission' , 'parent_id'
    ];
    protected $casts = [
        'status'    => 'integer',
        'is_featured'  => 'integer',
        'zones'  => 'array',
    ];

    public function services(){
        return $this->hasMany(Service::class, 'category_id','id');
    }
    public function scopeList($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }

    // public function subcategories()
    // {
    //     return $this->hasMany(SubCategory::class, 'category_id');
    // }
    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Define the relationship to the children (subcategories)
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    
}
