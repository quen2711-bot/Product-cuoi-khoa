@extends('layouts.app')

@section('title', 'Trang chủ - Lá Nhỏ Blog')

@section('content')

<section class="hero text-center mb-5">
    <h1 class="display-5 fw-bold">Chào mừng đến với Lá Nhỏ Blog</h1>
    <p class="lead mt-3">
        Một góc nhỏ để chia sẻ cuộc sống, học tập và những điều mình yêu thích.
    </p>
    <a href="#bai-viet" class="btn btn-danger mt-2">
        Khám phá bài viết
    </a>
</section>

<section id="bai-viet" class="mb-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">Bài viết mới nhất</h2>
        <p class="text-secondary">Những câu chuyện nhỏ mỗi ngày</p>
    </div>

    @php
        $posts = [
            [
                'title' => 'Một ngày sống chậm',
                'category' => 'Cuộc sống',
                'date' => '20/10/2026',
                'description' => 'Đôi khi chúng ta cần sống chậm lại để cảm nhận những điều bình dị xung quanh.',
                'image' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=800'
            ],
            [
                'title' => 'Bí quyết học tập hiệu quả',
                'category' => 'Học tập',
                'date' => '18/10/2026',
                'description' => 'Sắp xếp thời gian hợp lý và xây dựng thói quen học tập mỗi ngày.',
                'image' => 'https://images.unsplash.com/photo-1455390582262-044cdead277a?w=800'
            ],
            [
                'title' => 'Tìm niềm vui từ những điều nhỏ',
                'category' => 'Cảm hứng',
                'date' => '15/10/2026',
                'description' => 'Hạnh phúc đôi khi đến từ một tách trà, một cuốn sách hoặc một buổi chiều yên bình.',
                'image' => 'https://images.unsplash.com/photo-1445116572660-236099ec97a0?w=800'
            ]
        ];
    @endphp

    <div class="row">
        @if(count($posts) > 0)
            @foreach($posts as $post)
                @include('partials.post', ['post' => $post])
            @endforeach
        @else
            <div class="col-12 text-center">
                <p>Chưa có bài viết nào.</p>
            </div>
        @endif
    </div>
</section>

<section id="gioi-thieu" class="text-center py-5">
    <h2 class="fw-bold">Về Lá Nhỏ Blog</h2>
    <p class="mx-auto mt-3" style="max-width: 700px;">
        Đây là blog cá nhân chia sẻ những câu chuyện đời thường,
        kinh nghiệm học tập và nguồn cảm hứng tích cực.
        Cảm ơn bạn đã ghé thăm!
    </p>
</section>

@endsection