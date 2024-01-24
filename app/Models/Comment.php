<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'video_id',
        'description'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
