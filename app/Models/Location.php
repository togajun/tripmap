<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    
    //「1対多」の関係なので'posts'と複数形に
    public function posts()   
    {
        return $this->belongsTo(Post::class);  
    }
    
}