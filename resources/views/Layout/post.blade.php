<div class="col-md-6 col-lg-4 mb-4">
    <div class="card post-card shadow-sm">
        @if(!empty($post['image']))
            <img src="{{ $post['image'] }}" class="card-img-top"
                 alt="{{ $post['title'] }}">
        @endif

        <div class="card-body">
            <span class="badge text-bg-light mb-2">
                {{ $post['category'] }}
            </span>

            <h5 class="card-title">{{ $post['title'] }}</h5>

            <p class="text-secondary small">{{ $post['date'] }}</p>

            <p class="card-text">{{ $post['description'] }}</p>

            <a href="#gioi-thieu" class="btn btn-outline-danger">
                Đọc thêm
            </a>
        </div>
    </div>
</div>



5. File partials/footer.blade.php

<footer class="mt-5 py-4 text-center">
    <div class="container">
        <h5 class="brand">Lá Nhỏ Blog</h5>
        <p class="mb-1">Ghi lại những điều nhỏ bé trong cuộc sống.</p>
        <p class="small mb-0">
            © {{ date('Y') }} Lá Nhỏ Blog
        </p>
    </div>
</footer>