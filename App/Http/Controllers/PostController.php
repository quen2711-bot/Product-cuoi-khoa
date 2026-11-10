<?php
namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Hiển thị danh sách bài viết của người dùng đăng nhập
    public function index()
    {
        $posts = Auth::user()
            ->posts()
            ->with('category')
            ->withTrashed()
            ->latest()
            ->get();

        return view('post_index', compact('posts'));
    }

    // Hiển thị form tạo bài viết mới
    public function create()
    {
        return view('post_create', [
            'categories' => Category::all(),
            'tags' => Tag::all()
        ]);
    }

    // Lưu bài viết mới vào CSDL
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'        => 'required|string|max:255',
            'content'      => 'required|string',
            'image'        => 'nullable|image',
            'category_id'  => 'required|exists:categories,id',
            'tags'         => 'nullable|array',
            'status'       => 'required|in:draft,published,scheduled',
            'scheduled_at' => 'required_if:status,scheduled|nullable|date'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post = Auth::user()->posts()->create($data);

        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }

        Log::info('Tạo bài viết', [
            'nguoi_dung' => Auth::user()->name,
            'tieu_de'    => $post->title
        ]);

        return redirect()->route('post.index')->with('success', 'Đã lưu bài viết thành công!');
    }

    // Hiển thị form sửa bài viết
    public function edit(Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403, 'Bạn không có quyền sửa bài viết này.');
        }

        return view('post_edit', [
            'post'       => $post,
            'categories' => Category::all(),
            'tags'       => Tag::all()
        ]);
    }

    // Cập nhật bài viết
    public function update(Request $request, Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403, 'Bạn không có quyền sửa bài viết này.');
        }

        $this->validate($request, [
            'title'        => 'required|string|max:255',
            'content'      => 'required|string',
            'image'        => 'nullable|image',
            'category_id'  => 'required|exists:categories,id',
            'tags'         => 'nullable|array',
            'status'       => 'required|in:draft,published,scheduled',
            'scheduled_at' => 'required_if:status,scheduled|nullable|date'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        Log::info('Cập nhật bài viết', [
            'nguoi_dung' => Auth::user()->name,
            'tieu_de'    => $post->title
        ]);

        return redirect()->route('post.show', $post->slug)->with('success', 'Đã cập nhật bài viết!');
    }

    // Đưa bài viết vào thùng rác
    public function destroy(Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403, 'Bạn không có quyền xóa bài viết này.');
        }

        $post->delete();

        Log::info('Xóa bài viết vào thùng rác', [
            'nguoi_dung' => Auth::user()->name,
            'tieu_de'    => $post->title
        ]);

        return redirect()->route('post.index')->with('success', 'Đã đưa bài viết vào thùng rác.');
    }

    // Khôi phục bài viết từ thùng rác
    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);

        if (Auth::id() !== $post->user_id) {
            abort(403, 'Bạn không có quyền khôi phục bài viết này.');
        }

        $post->restore();

        return redirect()->route('post.index')->with('success', 'Đã khôi phục bài viết thành công!');
    }

    // Xóa vĩnh viễn bài viết
    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);

        if (Auth::id() !== $post->user_id) {
            abort(403, 'Bạn không có quyền xóa vĩnh viễn bài viết này.');
        }

        $post->forceDelete();

        Log::info('Xóa vĩnh viễn bài viết', [
            'nguoi_dung' => Auth::user()->name,
            'tieu_de'    => $post->title
        ]);

        return redirect()->route('post.index')->with('success', 'Đã xóa vĩnh viễn bài viết. Không thể hoàn tác!');
    }
}