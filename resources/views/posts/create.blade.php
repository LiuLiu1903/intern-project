{{-- resources/views/posts/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tạo bài viết mới</h1>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Tiêu đề:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="content">Nội dung:</label>
            <textarea id="content" name="content" required></textarea>
        </div>
        <button type="submit">Tạo bài viết</button>
    </form>
</div>
@endsection
