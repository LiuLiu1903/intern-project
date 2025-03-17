<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="email" name="email" value="{{ old('email') }}" required />
    @error('email')
        <span>{{ $message }}</span>
    @enderror
    <input type="password" name="password" required />
    @error('password')
        <span>{{ $message }}</span>
    @enderror
    <input type="password" name="password_confirmation" required />
    <button type="submit">Đặt lại mật khẩu</button>
</form>
