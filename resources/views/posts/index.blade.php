@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Danh sách bài viết</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="#" class="btn btn-primary">Tạo mới</a>
</div>
@endsection
