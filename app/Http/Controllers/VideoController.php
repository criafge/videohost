<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Grade;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVideoRequest $request)
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
            $grades = Grade::where('user_id', Auth::user()->id)->where('video_id', $video->id)->first();
        } else {
            $grades = null;
        }
        $comments = Comment::with('user')->where('video_id', $video->id)->get();
        return view('video', ['video' => $video, 'grade' => $grades, 'comments' => $comments->all()]);
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
    public function update(UpdateVideoRequest $request, Video $video)
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

    public function like(Video $video)
    {
        $grade = $this->getGrade($video->id);
        if ($grade !== null) {
            if ($grade->likes === 1) {
                $video->like -= 1;
                $grade->likes = false;
            } elseif ($grade->dislikes === 1) {
                $video->dislike -= 1;
                $video->like += 1;
                $grade->likes = true;
                $grade->dislikes = false;
            } else {
                $video->like += 1;
                $grade->likes = true;
            }
            $grade->save();
        } else {
            Grade::create([
                'video_id' => $video->id,
                'user_id' => Auth::user()->id,
                'likes' => true
            ]);
            $video->like += 1;
        }
        $video->save();
        return redirect()->back();
    }

    public function dislike(Video $video)
    {
        $grade = $this->getGrade($video->id);
        if ($grade !== null) {
            if ($grade->dislikes === 1) {
                $video->dislike -= 1;
                $grade->dislikes = false;
            } elseif ($grade->likes === 1) {
                $video->like -= 1;
                $video->dislike += 1;
                $grade->dislikes = true;
                $grade->likes = false;
            } else {
                $video->dislike += 1;
                $grade->dislikes = true;
            }
            $grade->save();
        } else {
            Grade::create([
                'video_id' => $video->id,
                'user_id' => Auth::user()->id,
                'dislikes' => true
            ]);
        }
        $video->save();
        return redirect()->back();
    }

    protected function getGrade($id)
    {
        return Auth::user()->grades($id);
    }
}
