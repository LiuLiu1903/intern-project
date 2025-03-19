<h1>Xin chào, {{ $user->first_name }}!</h1>
<p>Cảm ơn bạn đã đăng ký tài khoản. Vui lòng nhấp vào nút bên dưới để xác nhận tài khoản:</p>

<a href="{{ $verificationUrl }}" style="display:inline-block; padding: 10px 20px; background-color: #4CAF50; color: #fff; text-decoration: none; border-radius: 5px;">
    Xác nhận tài khoản
</a>

<p>Nếu bạn không đăng ký tài khoản, vui lòng bỏ qua email này.</p>
