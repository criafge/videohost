<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Video $video, Category $category)
    {
        $videos = $video->all();
        foreach($videos as $item){
            $item->status = $item->limit->title;
            $item->category = $item->category->title;
        }
        return view('admin.home', ['videos' => $videos, 'categories' => $category->all()]);
    }
}
