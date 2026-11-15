<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    // Trang chủ - Hiển thị bài viết mới nhất
    public function index(Request $request)
    {
        // Lấy 6 bài viết mới nhất đã xuất bản
        $posts = Post::with(['user', 'category'])
            ->where('status', 'published')
            ->latest()
            ->take(6)
            ->get();

        // Lấy danh mục và thẻ cho bộ lọc
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('welcome', compact('posts', 'categories', 'tags'));
    }

    // Trang Blog - Danh sách tất cả bài viết
    public function blog(Request $request)
    {
        $query = Post::with(['user', 'category'])
            ->where('status', 'published');

        // Tìm kiếm
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                  ->orWhere('content', 'like', "%{$request->search}%");
            });
        }

        // Lọc theo danh mục
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        // Lọc theo thẻ
        if ($request->tag) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('tags.id', $request->tag);
            });
        }

        $posts = $query->latest()->paginate(12);
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('blog', compact('posts', 'categories', 'tags'));
    }

    // Trang chi tiết bài viết
    public function show($slug)
    {
        $post = Post::with(['user', 'category', 'tags', 'comments.user'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('post_show', compact('post'));
    }
}
