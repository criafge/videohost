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
                <div class="d-flex gap-2 align-items-center">
                    <div>{{ $video->like }}</div><a class="" href="{{ route('like', $video->id) }}">
                        @if ($grade !== null && $grade->likes === true)
                            <img style="width: 40px" src="/img/like-true.png" alt="">
                        @else
                            <img style="width: 40px" src="/img/like.png" alt="">
                        @endif
                    </a>
                </div>
                <div class="d-flex gap-2 align-items-center">
                    <div>{{ $video->dislike }}</div><a class="" href="{{ route('dislike', $video->id) }}"><img
                            style="width: 40px; transform: rotate(180deg);" src="/img/dislike.png" alt=""></a>
                </div>
            </div>
        </div>
        <div>
            <p>{{ $video->description }}</p>
            <p>{{ $video->created_at }}</p>
        </div>
        <div>
            <h3>Комментарии</h3>
        </div>
    </div>
@endsection
