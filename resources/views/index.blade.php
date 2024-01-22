@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between gap-3">

            @foreach ($videos as $item)
                <div class="card bg-dark text-light shadow">
                    <h5 class="card-header">{{ $item->title }}</h5>
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->category_id }}</h5>
                        <p class="card-text">{{ $item->description }}</p>
                        <p class="card-text">{{ $item->created_at }}</p>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('videos.show', $item->id) }}" class="btn btn-danger">Смотреть</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
