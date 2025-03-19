@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Bài Viết của Bạn</h2>
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Thêm bài viết mới</a>

    @if ($posts->count() > 0)
        @foreach ($posts as $post)
            <div class="card mb-3">
                <div class="row g-0">
                    @if ($post->thumbnail)
                        <div class="col-md-3">
                            <img src="{{ $post->thumbnail }}" class="img-fluid rounded-start" alt="Thumbnail">
                        </div>
                    @endif
                    <div class="col-md-9">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->description }}</p>
                            <p class="card-text">
                                <small class="text-muted">
                                    Trạng thái: 
                                    <span class="badge {{ $post->status == 2 ? 'bg-success' : ($post->status == 1 ? 'bg-warning' : 'bg-secondary') }}">
                                        {{ $post->status == 2 ? 'Xuất bản' : ($post->status == 1 ? 'Đã cập nhật' : 'Nháp') }}
                                    </span>
                                </small>
                            </p>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info btn-sm">Xem</a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Chỉnh sửa</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Hiển thị phân trang --}}
        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    @else
        <p class="text-center">Chưa có bài viết nào.</p>
    @endif
</div>
@endsection
