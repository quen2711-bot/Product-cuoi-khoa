<?php
namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['user', 'category', 'tags'])->where('status', 'published');

        if ($request->search) {
            $k = $request->search;
            $query->where(function($q) use ($k) {
                $q->where('title', 'like', "%$k%")->orWhere('content', 'like', "%$k%");
            });
        }
        if ($request->category) $query->where('category_id', $request->category);
        if ($request->tag) $query->whereHas('tags', fn($q) => $q->where('tags.id', $request->tag));

        $posts = $query->latest()->paginate(6);
        return view('welcome', [
            'posts' => $posts,
            'categories' => Category::all(),
            'tags' => Tag::all()
        ]);
    }

    public function show($slug)
    {
        $post = Post::with(['user', 'category', 'tags', 'comments.user'])
            ->where('slug', $slug)->where('status', 'published')->firstOrFail();
        return view('post_detail', compact('post'));
    }
}