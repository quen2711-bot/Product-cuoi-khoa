@extends('Layout.master')
@section('title', $post->title . ' - Blog Mỹ Phẩm')
@section('content')
<style>
    .post-image {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(139, 90, 43, 0.15);
        margin: 20px 0;
    }
    .comment-box {
        background-color: #FFF8F5;
        border: 1px solid #F0D8C8;
        border-radius: 10px;
        padding: 20px;
        margin-top: 30px;
    }
    .btn-pink {
        background-color: #B97A65;
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 8px;
        cursor: pointer;
    }
    .btn-pink:hover {
        background-color: #9A6452;
    }
    .tag-badge {
        background-color: #F7E4D9;
        color: #8B5A2B;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 14px;
    }
</style>

<div style="max-width: 800px; margin: 40px auto; padding: 0 20px;">
    <h1 style="text-align: center; color: #6B4226; font-size: 36px; margin-bottom: 10px;">
        {{ $post->title }}
    </h1>

    <p style="text-align: center; color: #8B5A2B; margin-bottom: 30px;">
        👩‍💻 {{ $post->user->name }} | 📅 {{ $post->created_at->format('d/m/Y') }} | 
        📂 {{ $post->category ? $post->category->name : 'Chưa phân loại' }}
    </p>

    @if($post->image)
    <div style="text-align: center; margin-bottom: 30px;">
        <img src="{{ asset('storage/' . $post->image) }}" 
             alt="{{ $post->title }}" 
             class="post-image"
             style="max-height: 400px; object-fit: cover;">
    </div>
    @endif

    <div style="color: #5C3A21; font-size: 17px; line-height: 1.8; margin-bottom: 30px;">
        {!! nl2br(e($post->content)) !!}
    </div>

    @if($post->tags->count() > 0)
    <div style="margin-bottom: 30px;">
        <strong style="color: #6B4226;">Thẻ:</strong>
        @foreach($post->tags as $tag)
            <span class="tag-badge" style="margin-left: 5px;">{{ $tag->name }}</span>
        @endforeach
    </div>
    @endif

    <hr style="border: none; border-top: 1px solid #E8D4C4; margin: 30px 0;">

    <div class="comment-box">
        <h3 style="color: #6B4226; margin-top: 0;">💬 Bình luận ({{ $post->comments->count() }})</h3>

        @forelse($post->comments as $comment)
        <div style="background: #FFF; padding: 15px; border-radius: 8px; margin-bottom: 15px;">
            <strong style="color: #8B5A2B;">{{ $comment->user->name }}</strong>
            <small style="color: #A08060;"> - {{ $comment->created_at->format('d/m/Y H:i') }}</small>
            <p style="margin-top: 8px; color: #5C3A21;">{{ $comment->content }}</p>
        </div>
        @empty
        <p style="color: #A08060; font-style: italic;">Chưa có bình luận nào. Hãy là người đầu tiên bình luận nhé!</p>
        @endforelse

        @auth
        <form action="{{ route('comments.store', $post) }}" method="POST">
            @csrf
            <div style="margin-top: 25px;">
                <label style="color: #6B4226; font-weight: bold;">Viết bình luận của bạn:</label>
                <textarea name="content" rows="4" required
                    style="width: 100%; margin-top: 8px; padding: 12px; border: 1px solid #E0C8B8; border-radius: 8px; background: #FFF; color: #5C3A21;"
                    placeholder="Chia sẻ cảm nhận về bài viết này..."></textarea>
            </div>
            <button type="submit" class="btn-pink" style="margin-top: 12px;">Gửi bình luận</button>
        </form>
        @else
        <p style="margin-top: 20px; color: #8B5A2B;">
            👉 <a href="{{ route('login') }}" style="color: #B97A65; font-weight: bold;">Đăng nhập</a> để bình luận
        </p>
        @endauth
    </div>

    <div style="text-align: center; margin-top: 40px;">
        <a href="{{ route('blog') }}" style="color: #B97A65; text-decoration: none;">← Quay lại Blog</a>
    </div>
</div>
@endsection
