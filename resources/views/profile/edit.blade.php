<form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PUT')

    <!-- First Name -->
    <div>
        <label for="first_name">Họ</label>
        <input type="text" name="first_name" value="{{ old('first_name', auth()->user()->first_name) }}">
        @error('first_name')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <!-- Last Name -->
    <div>
        <label for="last_name">Tên</label>
        <input type="text" name="last_name" value="{{ old('last_name', auth()->user()->last_name) }}">
        @error('last_name')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <!-- Address -->
    <div>
        <label for="address">Địa chỉ</label>
        <input type="text" name="address" value="{{ old('address', auth()->user()->address) }}">
        @error('address')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">Cập nhật</button>
</form>
@if (session('success'))
    <div class="text-green-500">
        {{ session('success') }}
    </div>
@endif
