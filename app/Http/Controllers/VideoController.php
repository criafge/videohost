<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Grade;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $filename = $request->file('video')->getClientOriginalName();
        $path = $request->file('video')->storeAs('public', $filename);
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
        if (Auth::user()) {
            $grades = Grade::where('user_id', Auth::user()->id)->where('video_id', $video->id)->get();
        } else {
            $grades = null;
        }
        return view('video', ['video' => $video, 'grade' => $grades]);
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

    public function like(Video $video){
        $video->like += 1;
        $video->save();
        Grade::create([
            'video_id' => $video->id,
            'user_id' => Auth::user()->id,
            'likes' => true
        ]);
        return redirect()->back();
    }

    public function dislike(){

    }
}



