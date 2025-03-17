<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <input type="email" name="email" value="{{ old('email') }}" required />
    @error('email')
        <span>{{ $message }}</span>
    @enderror
    <button type="submit">Gửi link đặt lại mật khẩu</button>
</form>
