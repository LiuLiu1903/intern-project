@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h1>Danh sách bài viết</h1>
    <a href="{{ route('posts.create') }}" class="btn btn-primary">Tạo mới</a>
@endsection

