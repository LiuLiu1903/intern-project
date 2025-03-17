<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest('publish_date')
            ->where('status', 1) // Lọc bài viết đã được duyệt
            ->get();

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100',
            'content' => 'required',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->content = $request->content;
        $post->user_id = Auth::id();
        $post->status = 0; // Mặc định là bài viết mới
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Bài viết đã được tạo thành công.');
    }
}
