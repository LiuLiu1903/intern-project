@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Cập nhật hồ sơ</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')  <!-- Bắt buộc để Laravel hiểu đây là PUT request -->
        
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name:</label>
            <input type="text" class="form-control" name="first_name" value="{{ old('first_name', Auth::user()->first_name) }}">
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name:</label>
            <input type="text" class="form-control" name="last_name" value="{{ old('last_name', Auth::user()->last_name) }}">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address:</label>
            <input type="text" class="form-control" name="address" value="{{ old('address', Auth::user()->address) }}">
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật hồ sơ</button>
    </form>
</div>
@endsection
