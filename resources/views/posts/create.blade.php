@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tạo Bài Viết Mới</h2>
    
    {{-- ✅ Hiển thị thông báo thành công nếu có --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf

        {{-- Tiêu đề --}}
        <div class="form-group">
            <label>Tiêu đề</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Mô tả --}}
        <div class="form-group">
            <label>Mô tả</label>
            <input type="text" name="description" class="form-control" value="{{ old('description') }}">
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Nội dung (Summernote) --}}
        <div class="form-group">
            <label>Nội dung</label>
            <textarea id="summernote" name="content" class="form-control">{{ old('content') }}</textarea>
            @error('content')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Ngày xuất bản --}}
        <div class="form-group">
            <label>Ngày xuất bản</label>
            <input type="datetime-local" name="publish_date" class="form-control" value="{{ old('publish_date') }}">
            @error('publish_date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Trạng thái --}}
        <div class="form-group">
            <label>Trạng thái</label>
            <select name="status" class="form-control">
                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Bài viết mới</option>
                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Đã cập nhật</option>
                <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Đã xuất bản</option>
            </select>
            @error('status')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Ảnh đại diện --}}
        <div class="form-group">
            <label>Ảnh đại diện</label>
            <input type="file" name="thumbnail" class="form-control">
            @error('thumbnail')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Nút Lưu --}}
        <button type="submit" class="btn btn-success">Lưu bài viết</button>
    </form>
</div>

{{-- ✅ Thêm Summernote --}}
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
@endsection
