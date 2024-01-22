<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Video $video)
    {
        $videos = $video->where('limit_id', 1)->get()->sortByDesc('created_at');
        return view('index', ['videos' => $videos]);    }
}
