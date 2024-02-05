@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <ul class="list-group list-group-horizontal" style="height: 30xp">
                <li class="list-group-item"><a href="/home"><img style="width: 30px;" src="img/desc-sort.png"
                            alt="<"></a></li>
                <li class="list-group-item"><a href="/home?sort=desc"><img style="width: 30px;" src="img/asc-sort.png"
                            alt=">"></a></li>
            </ul>
        </div>
        @foreach ($videos as $item)
            <div>
                <div class="card bg-dark text-light shadow">
                    <h5 class="card-header">{{ $item->title }}</h5>
                    <div class="card-body">
                        <p class="card-text">{{ $item->description }}</p>
                        <p class="card-text">{{ $item->created_at }}</p>
                        <p class="card-text">{{ $item->status }}</p>
                        <div class="d-flex gap-3">
                            <div class="d-flex gap-3">
                                <div>{{ $item->like }}</div><img style="width: 30px" src="/img/like.png" alt="">
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <div>{{ $item->dislike }}</div><img style="width: 30px; transform: rotate(180deg)"
                                    src="/img/dislike.png" alt="">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex gap-3">
                                <a href="{{ route('change-status', [$item->id, 2]) }}" class="btn btn-outline-light">Нарушение
                                    👺</a>
                                <a href="{{ route('change-status', [$item->id, 3]) }}" class="btn btn-outline-light">Теневой
                                    бан👹</a>
                                <a href="{{ route('change-status', [$item->id, 4]) }}" class="btn btn-outline-light">Бан 💀</a>
                                <a href="{{ route('change-status', [$item->id, 1]) }}" class="btn btn-outline-danger">Снять ограничения 😜</a>
                            </div>
                            <a href="{{ route('videos.show', $item->id) }}" class="link-light">Перейти к странице
                                видео</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
