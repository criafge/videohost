<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (!isset($request->sort)) {
            $videos = Video::where('user_id', Auth::user()->id)->orderBy('like', 'desc')->get();
        } else {
            $videos = Video::where('user_id', Auth::user()->id)->orderBy('dislike', 'desc')->get();
        }
        return Auth::user()->role_id === 1 ? redirect('admin') : view('home', ['categories' => Category::all(), 'videos' => $videos]);
    }
}
