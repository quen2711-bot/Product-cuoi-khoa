@extends('Layout.master')
@section('title', 'Trang chủ - Blog Mỹ Phẩm')
@section('content')
<style>
    body {
        background-color: #FFF5F0;
    }
    .hero {
        text-align: center;
        padding: 50px 20px 30px;
    }
    .hero h1 {
        color: #6B4226;
        font-size: 42px;
        margin-bottom: 10px;
    }
    .hero p {
        color: #8B5A2B;
        font-size: 18px;
    }
    .search-bar {
        max-width: 900px;
        margin: 30px auto;
        background: #FFFFFF;
        padding: 25px;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(139, 90, 43, 0.08);
    }
    .search-bar form {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    .search-bar input,
    .search-bar select {
        flex: 1;
        min-width: 180px;
        padding: 12px 16px;
        border: 1px solid #F0D8C8;
        border-radius: 8px;
        font-size: 15px;
        background: #FFFFFF;
        color: #5C3A21;
    }
    .search-bar button {
        padding: 12px 25px;
        background-color: #B97A65;
        color: #FFFFFF;
        border: none;
        border-radius: 8px;
        font-size: 15px;
        cursor: pointer;
    }
    .search-bar button:hover {
        background-color: #9A6452;
    }
    .section-title {
        text-align: center;
        color: #6B4226;
        font-size: 28px;
        margin: 40px 0 25px;
    }
    .posts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 25px;
        max-width: 1200px;
        margin: 0 auto 50px;
        padding: 0 20px;
    }
    .post-card {
        background: #FFFFFF;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(139, 90, 43, 0.08);
        transition: transform 0.3s ease;
        text-decoration: none;
        display: block;
    }
    .post-card:hover {
        transform: translateY(-5px);
    }
    .post-card-image {
        height: 200px;
        background-color: #F8EDE4;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .post-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .post-card-content {
        padding: 20px;
    }
    .post-category {
        display: inline-block;
        background: #F7E4D9;
        color: #8B5A2B;
        font-size: 13px;
        padding: 4px 12px;
        border-radius: 15px;
        margin-bottom: 10px;
    }
    .post-title {
        color: #6B4226;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
    }
    .post-excerpt {
        color: #806A5C;
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 15px;
    }
    .post-meta {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        color: #A08878;
    }
    .view-more {
        text-align: center;
        margin-bottom: 60px;
    }
    .btn-view-more {
        display: inline-block;
        padding: 10px 30px;
        background: transparent;
        border: 2px solid #B97A65;
        color: #B97A65;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .btn-view-more:hover {
        background: #B97A65;
        color: #FFFFFF;
    }
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #907A70;
    }
    .btn-primary {
        display: inline-block;
        margin-top: 20px;
        background: #B97A65;
        color: #FFFFFF;
        padding: 10px 25px;
        border-radius: 8px;
        text-decoration: none;
    }
    .btn-primary:hover {
        background: #9A6452;
    }
</style>

<!-- Phần Chào mừng -->
<div class="hero">
    <h1>✨ Chào mừng đến với Blog Mỹ Phẩm</h1>
    <p>Khám phá bí quyết làm đẹp & chăm sóc da mỗi ngày</p>
</div>

<!-- Thanh Tìm Kiếm & Lọc -->
<div class="search-bar">
    <form action="{{ route('blog') }}" method="GET">
        <input type="text" name="search" placeholder="Tìm kiếm bài viết..." value="{{ request('search') }}">
        
        <select name="category">
            <option value="">Tất cả danh mục</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
            @endforeach
        </select>

        <select name="tag">
            <option value="">Tất cả thẻ</option>
            @foreach($tags as $tag)
            <option value="{{ $tag->id }}" {{ request('tag') == $tag->id ? 'selected' : '' }}>
                {{ $tag->name }}
            </option>
            @endforeach
        </select>

        <button type="submit">Tìm kiếm</button>
    </form>
</div>

<!-- Bài Viết Mới Nhất -->
<h2 class="section-title">🔥 Bài viết mới nhất</h2>

@if($posts->count() > 0)
    <div class="posts-grid">
        @foreach($posts as $post)
        <a href="{{ route('post.show', $post->slug) }}" class="post-card">
            <div class="post-card-image">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                @else
                    <span style="font-size: 40px;">🌸</span>
                @endif
            </div>
            <div class="post-card-content">
                <span class="post-category">
                    {{ $post->category ? $post->category->name : 'Chưa phân loại' }}
                </span>
                <h3 class="post-title">{{ Str::limit($post->title, 45) }}</h3>
                <p class="post-excerpt">{{ Str::limit(strip_tags($post->content), 80) }}</p>
                <div class="post-meta">
                    <span>✍️ {{ $post->user->name }}</span>
                    <span>📅 {{ $post->created_at->format('d/m/Y') }}</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <div class="view-more">
        <a href="{{ route('blog') }}" class="btn-view-more">Xem tất cả bài viết →</a>
    </div>
@else
    <div class="empty-state">
        <p style="font-size: 18px;">🌸 Chưa có bài viết nào. Hãy là người đầu tiên viết bài nhé!</p>
        @auth
            <a href="{{ route('post.create') }}" class="btn-primary">+ Viết bài đầu tiên</a>
        @endauth
    </div>
@endif

@endsection
