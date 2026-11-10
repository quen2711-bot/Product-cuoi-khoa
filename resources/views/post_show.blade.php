@extends('Layout.master')
@section('title', $post->title)
@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <h1 class="text-center">{{ $post->title }}</h1>
    
    <p class="text-center" style="color: #907A70; margin-bottom: 30px;">
        ✍️ {{ $post->user->name }} &nbsp;|&nbsp; 📅 {{ $post->created_at->format('d/m/Y') }} &nbsp;|&nbsp; 📂 {{ $post->category->name }}
    </p>

    @if($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" style="width: 100%; border-radius: 15px; margin-bottom: 30px; object-fit: cover; max-height: 400px;">
    @endif

    <div style="font-size: 17px; line-height: 1.8; margin-bottom: 30px;">
        {!! nl2br(e($post->content)) !!}
    </div>

    @if($post->tags->count() > 0)
        <p style="margin-bottom: 25px;">
            <strong>Thẻ:</strong>
            @foreach($post->tags as $tag)
                <span class="badge" style="background: #F8E2D6; color: #8B5A4B; margin: 3px;">{{ $tag->name }}</span>
            @endforeach
        </p>
    @endif

    @if(Auth::check() && Auth::id() == $post->user_id)
        <div style="margin-bottom: 40px;">
            <a href="{{ route('post.edit', $post) }}" class="btn btn-warning">✏️ Sửa bài</a>
            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn chắc chắn xóa bài viết này?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger">🗑️ Xóa vào thùng rác</button>
            </form>
        </div>
    @endif

    <hr style="border: none; border-top: 2px solid #F0E2DC; margin: 40px 0;">

    <h3>💬 Bình luận ({{ $post->comments->count() }})</h3>

    @auth
        <form method="POST" action="{{ route('comments.store', $post) }}" style="margin-bottom: 35px;">
            @csrf
            <div class="form-group">
                <label class="form-label">Viết bình luận của bạn</label>
                <textarea name="content" class="form-control" rows="4" required placeholder="Chia sẻ cảm nhận về bài viết này..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Gửi bình luận</button>
        </form>
    @else
        <p style="margin-bottom: 25px; color: #706058;">
            Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để bình luận.
        </p>
    @endauth

    @foreach($post->comments as $cmt)
        <div class="card" style="margin-bottom: 15px;">
            <div class="card-body" style="padding: 18px 22px;">
                <p style="margin-bottom: 8px;">
                    <strong style="color: #704A3C;">{{ $cmt->user->name }}</strong>
                    <span style="color: #907A70; font-size: 13px; margin-left: 10px;">{{ $cmt->created_at->diffForHumans() }}</span>
                </p>
                <p style="color: #5A3E36; margin-bottom: 10px;">{{ $cmt->content }}</p>
                
                @if(Auth::check() && (Auth::id() == $cmt->user_id || Auth::id() == $post->user_id || Auth::user()->is_admin))
                    <form action="{{ route('comments.destroy', $cmt) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa bình luận này?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger" style="padding: 6px 12px; font-size: 13px;">Xóa</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection