<?php

namespace App\Http\Controllers;

use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::latest('publish_date') // Lấy bài viết mới nhất lên đầu
            ->where('status', 1) // Chỉ lấy bài viết đã được duyệt
            ->get();

        return view('dashboard.index', ['posts' => $posts]);
    }
}