@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>
    <p>Chào mừng bạn đến với trang quản trị!</p>

    <div class="row">
        @foreach ($posts as $post)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ $post->thumbnail }}" class="card-img-top" alt="Thumbnail">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->description }}</p>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                    <div class="card-footer text-muted">
                        Ngày đăng: {{ $post->publish_date ? $post->publish_date->format('d/m/Y') : 'Chưa công khai' }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
