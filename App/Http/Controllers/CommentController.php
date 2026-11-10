<?php
namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendCommentNotification;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function __construct() { $this->middleware('auth'); }

    public function store(Request $request, Post $post)
    {
        $this->validate($request, ['content' => 'required']);

        $comment = Comment::create([
            'content' => $request->content,
            'post_id' => $post->id,
            'user_id' => Auth::id()
        ]);

        if (Auth::id() !== $post->user_id) {
            SendCommentNotification::dispatch($post, $comment);
        }

        Log::info('Bình luận', ['người' => Auth::user()->name, 'bài' => $post->title]);
        return redirect()->route('post.show', $post->slug)->with('success', 'Bình luận thành công!');
    }

    public function destroy(Comment $comment)
    {
        $post = $comment->post;
        $ok = Auth::id() === $comment->user_id || Auth::id() === $post->user_id || Auth::user()->is_admin;
        if (!$ok) abort(403, 'Không có quyền xóa bình luận này');

        $comment->delete();
        Log::info('Xóa bình luận', ['người xóa' => Auth::user()->name]);
        return redirect()->route('post.show', $post->slug)->with('success', 'Đã xóa bình luận');
    }
}