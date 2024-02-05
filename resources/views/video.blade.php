@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">
        <video controls class="w-75">
            <source src="{{ Storage::url($video->video) }}" type="video/mp4">
        </video>
    </div>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center p-4">
            <h3>{{ $video->title }}</h3>
            <div class="d-flex align-items-center gap-5">
                <div class="d-flex gap-2 align-items-center">
                    <div>{{ $video->like }}</div><a href="{{ route('change-grade', [$video->id, 1]) }}">
                        @if ($grade !== null && $grade->like === 1)
                            <img style="width: 40px" src="/img/like-true.png" alt="">
                        @else
                            <img style="width: 40px" src="/img/like.png" alt="">
                        @endif
                    </a>
                </div>
                <div class="d-flex gap-2 align-items-center">
                    <div>{{ $video->dislike }}</div><a href="{{ route('change-grade', [$video->id, 0]) }}">
                        @if ($grade !== null && $grade->dislike === 1)
                            <img style="width: 40px; transform: rotate(180deg)" src="/img/dislike-true.png" alt="">
                        @else
                            <img style="width: 40px; transform: rotate(180deg)" src="/img/dislike.png" alt="">
                        @endif
                    </a>
                </div>
            </div>
        </div>
        <div>
            <p>{{ $video->description }}</p>
            <p>{{ $video->created_at }}</p>
        </div>
        <div>
            <h4>Комментарии</h4>
            <form action="{{ route('videos.comments.store', $video->id) }}" method="post">
                @csrf
                <textarea name="description" class="form-control bg-dark text-light" placeholder="Оставить комментарий"></textarea>
                <div class="d-flex justify-content-end m-2">
                    <input class="btn btn-danger" type="submit" value="Оставить комментарий">
                </div>
            </form>
            <div>
                @foreach ($comments as $item)
                    <div class="card text-bg-dark">
                        <div class="card-header d-flex justify-content-between">
                            <div>{{ $item->user->name }}</div>
                            @if ($item->user_id === auth()->user()->id)
                                <form action="{{route('videos.comments.destroy', [$video->id, $item->id])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-dark" type="submit" >Удалить</button>
                                </form>
                            @endif
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <p>{{ $item->description }}</p>
                                <footer class="footer fs-6">{{ $item->created_at }}</footer>
                            </blockquote>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
