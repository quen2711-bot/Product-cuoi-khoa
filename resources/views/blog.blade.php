@extends('Layout.master')
@section('title', 'Blog')
@section('content')
<h2 class="mb-4">📝 Bài viết mới nhất</h2>

@if($posts->count() > 0)
    <div class="row">
        @foreach($posts as $post)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text text-muted">
                        <small>Tác giả: {{ $post->user->name }} — {{ $post->created_at->format('d/m/Y') }}</small>
                    </p>
                    <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                    <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $posts->links() }}
    </div>
@else
    <p>Chưa có bài viết nào. <a href="{{ route('posts.create') }}">Viết bài đầu tiên</a>!</p>
@endif
@endsection