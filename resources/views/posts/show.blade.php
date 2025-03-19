@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>{{ $post->title }}</h2>
        </div>
        <div class="card-body">
            {{-- ✅ Hiển thị ảnh đại diện (dùng Spatie Media) --}}
            @if ($post->getFirstMediaUrl('thumbnails'))
                <img src="{{ $post->getFirstMediaUrl('thumbnails') }}" 
                     alt="Thumbnail" 
                     class="img-fluid mb-3" 
                     style="max-height: 300px;">
            @endif
            
            {{-- ✅ Hiển thị các ảnh khác trong nội dung (nếu có) --}}
            @if ($post->getMedia('content_images')->count())
                <div class="mt-3">
                    <h5>Thư viện ảnh:</h5>
                    <div class="d-flex flex-wrap">
                        @foreach ($post->getMedia('content_images') as $media)
                            <img src="{{ $media->getUrl() }}" 
                                 alt="Image" 
                                 class="img-thumbnail mr-2 mb-2" 
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- ✅ Hiển thị mô tả --}}
            <p><strong>Mô tả:</strong> {{ $post->description }}</p>

            {{-- ✅ Hiển thị nội dung --}}
            <div>
                <strong>Nội dung:</strong>
                <div class="mt-2">
                    {!! $post->content !!}
                </div>
            </div>

            {{-- ✅ Hiển thị ngày xuất bản --}}
            <p class="mt-3">
                <strong>Ngày xuất bản:</strong> 
                {{ date('d/m/Y H:i', strtotime($post->publish_date)) }}
            </p>

            {{-- ✅ Hiển thị trạng thái --}}
            <p>
                <strong>Trạng thái:</strong>
                @if ($post->status == 0)
                    <span class="badge badge-secondary">Bài viết mới</span>
                @elseif ($post->status == 1)
                    <span class="badge badge-warning">Đã cập nhật</span>
                @elseif ($post->status == 2)
                    <span class="badge badge-success">Đã xuất bản</span>
                @endif
            </p>

            {{-- ✅ Nút Chỉnh Sửa và Xóa --}}
            <div class="mt-4">
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Chỉnh sửa</a>

                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa bài viết này?')">Xóa</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
