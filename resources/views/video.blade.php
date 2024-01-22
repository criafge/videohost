@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">
        <video controls class="w-75">
            <source src="{{ Storage::url('video.mp4') }}" type="video/mp4">
        </video>
    </div>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center p-4">
            <h3>{{ $video->title }}</h3>
            <div class="d-flex align-items-center gap-5">
                <a href=""><img style="width: 40px;" src="/img/like.png" alt=""></a>
                <a href=""><img style="width: 40px; transform: rotate(180deg)" src="/img/dislike.png"
                        alt=""></a>
            </div>
        </div>
        <div>
            <p>{{ $video->description }}</p>
            <p>{{$video->created_at}}</p>
        </div>
        <div>
            <h3>Комментарии</h3>
        </div>
    </div>
@endsection
