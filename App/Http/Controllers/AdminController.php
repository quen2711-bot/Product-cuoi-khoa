<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Auth::user() || !Auth::user()->is_admin) {
                abort(403, 'Chỉ quản trị viên mới truy cập được trang này');
            }
            return $next($request);
        });
    }

    // Trang thống kê
    public function index()
    {
        $soThanhVien = User::count();
        $soBaiDang = Post::where('status', 'published')->count();
        $soBinhLuan = Comment::count();
        
        $topBaiViet = Post::withCount('comments')
                        ->orderBy('comments_count', 'desc')
                        ->limit(5)
                        ->get();

        return view('admin.dashboard', compact(
            'soThanhVien',
            'soBaiDang',
            'soBinhLuan',
            'topBaiViet'
        ));
    }

    // Quản lý danh mục - danh sách
    public function categoriesIndex()
    {
        $danhMucs = Category::all();
        return view('admin.categories.index', compact('danhMucs'));
    }

    // Thêm danh mục
    public function storeCategory(Request $req)
    {
        $req->validate(['name' => 'required|string|max:255']);
        Category::create($req->only('name'));
        Log::info('Admin thêm danh mục', ['tên' => $req->name]);
        return back()->with('success', 'Đã thêm danh mục');
    }

    // Sửa danh mục
    public function updateCategory(Request $req, Category $category)
    {
        $req->validate(['name' => 'required|string|max:255']);
        $category->update($req->only('name'));
        Log::info('Admin sửa danh mục');
        return back()->with('success', 'Đã cập nhật danh mục');
    }

    // Xóa danh mục
    public function deleteCategory(Category $category)
    {
        $category->delete();
        Log::info('Admin xóa danh mục');
        return back()->with('success', 'Đã xóa danh mục');
    }

    // Xem tất cả bài viết
    public function allPosts()
    {
        $tatCaBai = Post::with(['user', 'category'])
            ->withTrashed()
            ->latest()
            ->get();
            
        return view('admin.all_posts', compact('tatCaBai'));
    }

    // Xóa bình luận
    public function deleteComment(Comment $comment)
    {
        $comment->delete();
        Log::info('Admin xóa bình luận');
        return back()->with('success', 'Đã xóa bình luận');
    }
}