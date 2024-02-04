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


    public function changeGrade(Video $video, $whichGrade)
    {
        $grade = $this->getGrade($video->id);

        $item = $this->whichGrade($whichGrade);

        $grade_create = ['video_id' => $video->id,'user_id' => Auth::user()->id, $item => true];

        if ($grade !== null) {

            if ($grade->$item === 1) {
                $this->gradeFalse($item, $video, $grade);
            }
            elseif ($grade->like === 0 && $grade->dislike === 0) {
                $this->gradeTrue($item, $video, $grade);
            }
            else {
                $this->gradeTrue($item, $video, $grade);
                $this->gradeFalse($this->whichGrade(!$whichGrade), $video, $grade);
            }

            $grade->save();
        }
        else {
            Grade::create($grade_create);
            $video->$item += 1;
        }
        $video->save();
        return redirect()->back();
    }

    protected function gradeFalse($item, $video, $grade)
    {
        $video->$item -= 1;
        $grade->$item = false;
    }

    protected function gradeTrue($item, $video, $grade)
    {
        $video->$item += 1;
        $grade->$item = true;
    }
    protected function getGrade($id)
    {
        return Auth::user()->grades($id);
    }

    protected function whichGrade($item){
        return $item == true ? 'like' : 'dislike';
    }
}
