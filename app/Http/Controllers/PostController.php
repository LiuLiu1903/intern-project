<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // ✅ Danh sách bài viết
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    // ✅ Hiển thị form tạo bài viết
    public function create()
    {
        return view('posts.create');
    }

    // ✅ Lưu bài viết mới
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:100',
            'description' => 'nullable|max:200',
            'content' => 'nullable|string',
            'publish_date' => 'nullable|date',
            'status' => 'required|in:0,1,2',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = Auth::user()->posts()->create($data);

        // ✅ Lưu ảnh đại diện nếu có
        if ($request->hasFile('thumbnail')) {
            $imagePath = $request->file('thumbnail')->store('thumbnails', 'public');
            $post->update(['thumbnail' => $imagePath]);
        }

        return redirect()->route('posts.index')->with('success', 'Bài viết đã được tạo.');
    }

    // ✅ Upload ảnh từ Summernote
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('file')) {
            $imagePath = $request->file('file')->store('uploads', 'public');
            $url = asset('storage/'.$imagePath);

            return response()->json(['url' => $url]);
        }

        return response()->json(['error' => 'Không có ảnh nào được tải lên'], 400);
    }

    // ✅ Hiển thị bài viết
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // ✅ Chỉnh sửa bài viết
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // ✅ Cập nhật bài viết
    public function update(Request $request, Post $post)
    {
        // ✅ Kiểm tra quyền sở hữu
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error', 'Bạn không có quyền chỉnh sửa bài viết này.');
        }

        $data = $request->validate([
            'title' => 'required|max:100',
            'description' => 'nullable|max:200',
            'content' => 'nullable|string',
            'publish_date' => 'nullable|date',
            'status' => 'required|in:0,1,2',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post->update($data);

        // ✅ Cập nhật ảnh đại diện nếu có
        if ($request->hasFile('thumbnail')) {
            // Xóa ảnh cũ
            if ($post->thumbnail) {
                Storage::disk('public')->delete($post->thumbnail);
            }

            // Lưu ảnh mới
            $imagePath = $request->file('thumbnail')->store('thumbnails', 'public');
            $post->update(['thumbnail' => $imagePath]);
        }

        return redirect()->route('posts.index')->with('success', 'Bài viết đã được cập nhật.');
    }

    // ✅ Xóa bài viết
    public function destroy(Post $post)
    {
        // ✅ Kiểm tra quyền sở hữu
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error', 'Bạn không có quyền xóa bài viết này.');
        }

        // ✅ Xóa ảnh đại diện nếu có
        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Bài viết đã được xóa.');
    }
}
