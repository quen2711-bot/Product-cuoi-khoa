<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">💄 Blog Mỹ Phẩm</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('welcome') }}">Trang chủ</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('blog') }}">Blog</a></li>
                @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('posts.create') }}">Viết bài</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Đăng xuất</a>
                            </li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Đăng nhập</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Đăng ký</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>