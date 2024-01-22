@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Изменить видео</h1>
        <form action="{{ route('videos.update', $video->id) }}" method="post">
            @method('PATCH')
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label text-dark">Введите название</label>
                <input type="text" class="form-control bg-dark text-light" name="title" value="{{ $video->title }}">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label text-dark">Введите описание</label>
                <textarea class="form-control bg-dark text-light" name="description">{{ $video->title }}</textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <select name="category_id" class="form-select bg-dark text-light">
                    @foreach ($categories as $item)
                        @if ($video->category_id === $item->id)
                            <option selected value="{{ $item->id }}">{{ $item->title }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <input class="btn btn-danger" type="submit" value="Изменить">
            </div>
        </form>
    </div>
@endsection
