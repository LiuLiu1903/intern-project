@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Chỉnh Sửa Bài Viết</h2>
    
    {{-- ✅ Hiển thị thông báo thành công --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- ✅ Form cập nhật --}}
    <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- ✅ Tiêu đề --}}
        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- ✅ Mô tả --}}
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <input type="text" name="description" class="form-control" value="{{ old('description', $post->description) }}">
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- ✅ Nội dung (Summernote) --}}
        <div class="mb-3">
            <label class="form-label">Nội dung</label>
            <textarea id="summernote" name="content" class="form-control">{{ old('content', $post->content) }}</textarea>
            @error('content')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- ✅ Ngày xuất bản --}}
        <div class="mb-3">
            <label class="form-label">Ngày xuất bản</label>
            <input type="datetime-local" name="publish_date" class="form-control" 
                   value="{{ old('publish_date', $post->publish_date ? date('Y-m-d\TH:i', strtotime($post->publish_date)) : '') }}">
            @error('publish_date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- ✅ Ẩn trường trạng thái --}}
        <input type="hidden" name="status" value="{{ $post->status }}">

        {{-- ✅ Upload ảnh đại diện --}}
        <div class="mb-3">
            <label class="form-label">Ảnh đại diện</label>
            <input type="file" name="thumbnail" class="form-control">
            @if ($post->thumbnail)
                <div class="mt-2">
                    <img src="{{ $post->thumbnail }}" alt="Thumbnail" class="img-thumbnail" width="150">
                </div>
            @endif
            @error('thumbnail')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- ✅ Nút Cập Nhật --}}
        <button type="submit" class="btn btn-primary">Cập nhật bài viết</button>
    </form>
</div>
@endsection

{{-- ✅ Kích hoạt Summernote --}}
@push('scripts')
<!-- Thêm Summernote từ CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300,  // Chiều cao của editor
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['picture', 'link', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                onImageUpload: function(files) {
                    let editor = $(this);
                    let formData = new FormData();
                    formData.append("file", files[0]);
                    formData.append("_token", "{{ csrf_token() }}");

                    $.ajax({
                        url: "{{ route('posts.upload.image') }}", 
                        method: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            editor.summernote('insertImage', response.url);
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }
            }
        });
    });
</script>
@endpush
