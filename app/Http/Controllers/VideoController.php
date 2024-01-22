<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Video $video)
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $filename = $request->file('video')->getClientOriginalName();
        $path = $request->file('video')->storeAs($filename);
        $data = array_merge($data, [
            'video' => $filename,
            'user_id' => Auth::user()->id,
        ]);
        Video::create($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        return view('video', ['video' => $video]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        return view('user.video-form', ['categories' => Category::all(), 'video' => $video]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        $video->update($request->all());
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->back();    
    }
}



