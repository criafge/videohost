<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Video $video)
    {
        $videos = $video->where('limit_id', 1)->get()->sortByDesc('created_at');
        foreach($videos as $item){
            $item->category = $item->category->title;
        }
        return view('index', ['videos' => $videos]);    }
}
