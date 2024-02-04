<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class LimitController extends Controller
{

    public function changeStatus(Video $video, $item)
    {
        $video->update([
            'limit_id' => $item
        ]);
        return redirect()->back();
    }
}
