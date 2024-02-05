<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'limit_id',
        'like',
        'dislike',
        'user_id',
        'video'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function limit(){
        return $this->belongsTo(Limit::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
