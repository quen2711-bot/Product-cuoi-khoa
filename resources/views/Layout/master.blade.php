<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog Mỹ Phẩm')</title>
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

        .nav-links {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .nav-links a,
        .nav-links button {
            color: #FDF2F4;
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .nav-links a:hover,
        .nav-links button:hover {
            color: #F8C8C0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 25px;
        }

        /* Thông báo */
        .alert {
            padding: 15px 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            border-left: 4px solid;
        }

        .alert-success {
            background: #E8F3E6;
            color: #4A7C45;
            border-color: #6FBF68;
        }

        .alert-danger {
            background: #F8D2CC;
            color: #7A4538;
            border-color: #C87968;
        }

        /* Nút bấm chung */
        .btn {
            display: inline-block;
            padding: 12px 25px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: 0.3s;
            font-size: 15px;
        }

        .btn-primary {
            background: linear-gradient(90deg, #C87968 0%, #D89788 100%);
            color: #FFFFFF;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(200, 121, 104, 0.35);
            color: #fff;
        }

        .btn-secondary {
            background: #E8CFC5;
            color: #5A3E36;
        }

        .btn-secondary:hover {
            background: #D8B9AA;
            color: #4A3228;
        }

        .btn-warning {
            background: linear-gradient(90deg, #E8B860 0%, #F0C888 100%);
            color: #5A3E36;
        }

        .btn-danger {
            background: linear-gradient(90deg, #C86858 0%, #D88878 100%);
            color: #FFFFFF;
        }

        /* Form */
        .form-group {
            margin-bottom: 22px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #8B5A4B;
            font-weight: 500;
        }

        .form-control,
        .form-select {
            width: 100%;
            padding: 12px 18px;
            border: 1px solid #E8CFC5;
            border-radius: 10px;
            font-size: 15px;
            background: #FEF7F5;
            color: #5A3E36;
            transition: 0.3s;
        }

        .form-control:focus,
        .form-select:focus {
            outline: none;
            border-color: #C88A78;
            box-shadow: 0 0 0 3px rgba(200, 136, 120, 0.15);
        }

        /* Thẻ bài viết */
        .card {
            background: #FFFFFF;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(139, 90, 75, 0.12);
            margin-bottom: 25px;
        }

        .card-body {
            padding: 22px;
        }

        /* Bảng */
        .table {
            width: 100%;
            border-collapse: collapse;
            background: #FFFFFF;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(139, 90, 75, 0.08);
        }

        .table th,
        .table td {
            padding: 14px 18px;
            text-align: left;
            border-bottom: 1px solid #F0E2DC;
        }

        .table th {
            background: #F8E2D6;
            color: #704A3C;
            font-weight: 600;
        }

        .table tr:hover {
            background: #FEF7F5;
        }

        .table-secondary td {
            background: #F3E9E4;
            color: #907A70;
        }

        /* Nhãn trạng thái */
        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .bg-success { background: #C8E6C9; color: #2E7D32; }
        .bg-warning { background: #FFE0B2; color: #E65100; }
        .bg-secondary { background: #E0E0E0; color: #616161; }
        .bg-danger { background: #FFCDD2; color: #C62828; }

        /* Footer */
        footer {
            background: linear-gradient(90deg, #8B5A4B 0%, #A67C6D 100%);
            color: #FDF2F4;
            text-align: center;
            padding: 25px;
            margin-top: 50px;
        }

        /* Link */
        a {
            color: #B06A5A;
            text-decoration: none;
            transition: 0.2s;
        }

        a:hover {
            color: #8B4F40;
            text-decoration: underline;
        }

        /* Tiêu đề */
        h1, h2, h3, h4, h5 {
            color: #704A3C;
            margin-bottom: 20px;
        }

        /* Khoảng cách */
        .text-center { text-align: center; }
        .mt-4 { margin-top: 25px; }
        .mb-4 { margin-bottom: 25px; }
        .d-inline { display: inline; }
    </style>
</head>
<body>
    <!-- Thanh điều hướng -->
    <nav>
        <a href="{{ url('/') }}" class="logo">💄 Blog Mỹ Phẩm</a>
        <div class="nav-links">
            <a href="{{ url('/') }}">Trang chủ</a>
            @auth
                <a href="{{ route('post.index') }}">Bài viết của tôi</a>
                <a href="{{ route('post.create') }}">Viết bài</a>
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}">Quản trị</a>
                @endif
                <span style="color: #FDF2F4;">👋 {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit">Đăng xuất</button>
                </form>
            @else
                <a href="{{ route('login') }}">Đăng nhập</a>
                <a href="{{ route('register') }}">Đăng ký</a>
            @endauth
        </div>
    </nav>

    <!-- Nội dung chính -->
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $loi)
                    <p style="margin: 5px 0;">• {{ $loi }}</p>
                @endforeach
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        <p>© 2026 Blog Mỹ Phẩm & Làm Đẹp — Đồ án CNTT</p>
    </footer>
</body>
</html>
