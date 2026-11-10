<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ - Blog Mỹ Phẩm</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: linear-gradient(180deg, #FDF2F4 0%, #F8E2D6 100%);
            min-height: 100vh;
            color: #5A3E36;
        }

        /* Thanh điều hướng */
        nav {
            background: linear-gradient(90deg, #8B5A4B 0%, #A67C6D 100%);
            padding: 16px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 3px 12px rgba(139, 90, 75, 0.2);
        }

        .logo {
            color: #FDF2F4;
            font-size: 22px;
            font-weight: bold;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-right a {
            color: #FDF2F4;
            text-decoration: none;
            margin-left: 25px;
            font-weight: 500;
            transition: 0.3s;
        }

        .nav-right a:hover {
            color: #F8C8C0;
        }

        /* Container chính */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 50px 25px;
        }

        h1 {
            text-align: center;
            color: #704A3C;
            font-size: 38px;
            margin-bottom: 45px;
        }

        /* Khối tìm kiếm */
        .search-box {
            background: #FFFFFF;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(139, 90, 75, 0.12);
            margin-bottom: 50px;
        }

        .search-row {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: center;
        }

        .search-row input,
        .search-row select {
            flex: 1;
            min-width: 200px;
            padding: 14px 20px;
            border: 1px solid #E8CFC5;
            border-radius: 12px;
            font-size: 15px;
            background: #FEF7F5;
            color: #5A3E36;
        }

        .search-row input:focus,
        .search-row select:focus {
            outline: none;
            border-color: #C88A78;
            box-shadow: 0 0 0 3px rgba(200, 136, 120, 0.15);
        }

        .btn-search {
            padding: 14px 35px;
            background: linear-gradient(90deg, #C87968 0%, #D89788 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-search:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(200, 121, 104, 0.35);
        }

        /* Thông báo */
        .alert-success {
            background: #E8F3E6;
            color: #4A7C45;
            padding: 15px 25px;
            border-radius: 12px;
            margin-bottom: 30px;
            border-left: 4px solid #6FBF68;
        }

        /* Danh sách bài viết */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #907A70;
            font-size: 18px;
        }

        /* Footer */
        footer {
            background: linear-gradient(90deg, #8B5A4B 0%, #A67C6D 100%);
            color: #FDF2F4;
            text-align: center;
            padding: 25px;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <!-- Thanh điều hướng -->
    <nav>
        <a href="{{ url('/') }}" class="logo">💄 Blog Mỹ Phẩm</a>
        <div class="nav-right">
            <a href="{{ url('/') }}">Trang chủ</a>
            @guest
                <a href="{{ url('/dang-nhap') }}">Đăng nhập</a>
                <a href="{{ url('/dang-ky') }}">Đăng ký</a>
            @else
                <span style="color: #FDF2F4;">👋 {{ Auth::user()->name }}</span>
                <a href="{{ url('/bai-viet-cua-toi') }}">Bài viết của tôi</a>
                <a href="{{ url('/viet-bai') }}">Viết bài</a>
                @if(Auth::user()->is_admin)
                    <a href="{{ url('/admin') }}">Quản trị</a>
                @endif
                <form action="{{ url('/dang-xuat') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: #FDF2F4; cursor: pointer; margin-left: 25px; font-size: 16px;">Đăng xuất</button>
                </form>
            @endguest
        </div>
    </nav>

    <!-- Nội dung chính -->
    <div class="container">
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <h1>✨ Chào mừng đến với Blog Mỹ Phẩm</h1>

        <!-- Tìm kiếm & Lọc -->
        <div class="search-box">
            <form method="GET" action="{{ url('/') }}">
                <div class="search-row">
                    <input type="text" name="search" placeholder="Tìm kiếm bài viết..." value="{{ request('search') }}">
                    <select name="category" onchange="this.form.submit()">
                        <option value="">Tất cả danh mục</option>
                        @if(isset($categories))
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    <select name="tag" onchange="this.form.submit()">
                        <option value="">Tất cả thẻ</option>
                        @if(isset($tags))
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" {{ request('tag') == $tag->id ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    <button type="submit" class="btn-search">Tìm</button>
                </div>
            </form>
        </div>

        <!-- Danh sách bài viết -->
        @if(isset($posts) && $posts->count() > 0)
            <div class="posts-grid">
                <!-- Sẽ bổ sung hiển thị bài viết khi có dữ liệu -->
            </div>
        @else
            <div class="empty-state">
                <p>🌸 Chưa có bài viết nào được đăng.</p>
                <p style="margin-top: 10px; font-size: 16px;">
                    <a href="{{ url('/dang-nhap') }}" style="color: #B06A5A;">Đăng nhập</a> và 
                    <a href="{{ url('/viet-bai') }}" style="color: #B06A5A;">viết bài đầu tiên</a> nhé!
                </p>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer>
        <p>© 2026 Blog Mỹ Phẩm & Làm Đẹp — Đồ án CNTT</p>
    </footer>
</body>
</html>