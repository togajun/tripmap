<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    protected $fillable = [
        'location_id',
        'title',
        'body',
        'image_path',
        'user_id',
        'category_id',
    ];
}
