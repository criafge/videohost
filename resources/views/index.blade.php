@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Последние видео</h1>
        <div class="d-flex justify-content-center gap-3 dsf">
            @foreach ($videos as $item)
                <div class="card bg-dark text-light shadow asdsad">
                    <video src="{{ Storage::url($item->video) }}"></video>
                    <h5 class="card-header">{{ $item->title }}</h5>
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->category }}</h5>
                        <div class="card-text">{{ $item->description }}</div>
                        <div class="card-text">{{ $item->created_at }}</div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('videos.show', $item->id) }}" class="btn btn-danger">Смотреть</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        .dsf{
            flex-wrap: wrap;

        }
        .asdsad{
            width: 400px;
        }
    </style>
@endsection
