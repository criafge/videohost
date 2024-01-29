<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class LimitController extends Controller
{
    public function a(Video $video){
        $video->update([
            'limit_id'=> 2
        ]);
        return redirect()->back();
    }
    public function b(Video $video){
        $video->update([
            'limit_id'=> 3
        ]);
        return redirect()->back();
    }
    public function c(Video $video){
        $video->update([
            'limit_id'=> 4
        ]);
        return redirect()->back();
    }
    public function d(Video $video){
        $video->update([
            'limit_id'=> 1
        ]);
        return redirect()->back();
    }
}
