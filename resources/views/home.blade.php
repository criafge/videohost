@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                <h1>Мои видео</h1>
            </div>
            <div>
                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">+</button>
            </div>
        </div>
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
                        <h5 class="card-title">{{ $item->category }}</h5>
                        <p class="card-text">{{ $item->description }}</p>
                        <p class="card-text">{{ $item->created_at }}</p>
                        <p class="card-text">{{ $item->status }}</p>
                        <div class="d-flex gap-3">
                            <div class="d-flex gap-3">
                                <div>{{ $item->like }}</div><img style="width: 30px" src="/img/like.png" alt="">
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <div>{{ $item->dislike }}</div><img style="width: 30px; transform: rotate(180deg)" src="/img/dislike.png" alt="">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex gap-3">
                                <a href="{{ route('videos.edit', $item->id) }}"
                                    class="btn btn-outline-light">Редактировать</a>

                                <form action="{{ route('videos.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" value="Удалить">
                                </form>
                            </div>
                            <a href="{{ route('videos.show', $item->id) }}" class="link-light">Перейти к странице
                                видео</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- create video modal --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Добавить видео</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('videos.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="title" class="form-label text-dark">Введите название</label>
                                <input type="text" class="form-control" name="title" placeholder="*">
                                @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label text-dark">Введите описание</label>
                                <textarea class="form-control" name="description"></textarea>
                                @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="video" class="form-label text-dark">Добавьте видео</label>
                                <input type="file" class="form-control" name="video">
                                @error('video')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <select name="category_id" class="form-select">
                                    <option selected disabled>Выберите категорию</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-dark">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
