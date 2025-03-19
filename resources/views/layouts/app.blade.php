<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: #fff;
            padding: 20px;
        }
        .sidebar a {
            color: #fff;
            display: block;
            padding: 10px;
            margin-bottom: 5px;
            text-decoration: none;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            padding: 20px;
        }
        .logout-btn {
            color: #fff;
            background-color: #dc3545;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            text-align: left;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 sidebar">
            <h4>Dashboard</h4>
            <a href="{{ route('dashboard') }}">🏠 Trang chủ</a>
            <a href="{{ route('posts.index') }}">📝 Quản lý bài viết</a>
            <a href="{{ route('profile.edit', auth()->id()) }}">👤 Hồ sơ</a>
            
            <!-- Nút Đăng xuất -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <button class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                🚪 Đăng xuất
            </button>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 content">
            @yield('content')
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
