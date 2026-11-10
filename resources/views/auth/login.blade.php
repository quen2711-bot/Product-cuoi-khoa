<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Blog Mỹ Phẩm</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #FDF2F4 0%, #F8E2D6 100%);
            min-height: 100vh;
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
        }

        .nav-links a {
            color: #FDF2F4;
            text-decoration: none;
            margin-left: 25px;
            font-weight: 500;
            transition: 0.3s;
        }

        .nav-links a:hover {
            color: #F8C8C0;
        }

        /* Thông báo lỗi/thành công */
        .alert {
            max-width: 450px;
            margin: 20px auto;
            padding: 14px 25px;
            border-radius: 12px;
            border-left: 4px solid;
        }

        .alert-error {
            background: #F8D2CC;
            color: #7A4538;
            border-color: #C87968;
        }

        .alert-success {
            background: #E8F3E6;
            color: #4A7C45;
            border-color: #6FBF68;
        }

        /* Khối đăng nhập */
        .login-container {
            max-width: 450px;
            margin: 30px auto;
            background: #FFFFFF;
            border-radius: 20px;
            padding: 40px 35px;
            box-shadow: 0 8px 25px rgba(139, 90, 75, 0.15);
        }

        .login-container h1 {
            text-align: center;
            color: #704A3C;
            margin-bottom: 35px;
            font-size: 28px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #8B5A4B;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 12px 18px;
            border: 1px solid #E8CFC5;
            border-radius: 10px;
            font-size: 15px;
            background: #FEF7F5;
            color: #5A3E36;
            transition: 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #C88A78;
            background: #FFFFFF;
            box-shadow: 0 0 0 3px rgba(200, 136, 120, 0.15);
        }

        .error-text {
            color: #C86858;
            margin-top: 8px;
            font-size: 14px;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(90deg, #C87968 0%, #D89788 100%);
            color: #FFFFFF;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(200, 121, 104, 0.35);
        }

        .links {
            text-align: center;
            margin-top: 25px;
        }

        .links a {
            color: #B06A5A;
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s;
        }

        .links a:hover {
            color: #8B4F40;
            text-decoration: underline;
        }

        .divider {
            margin: 20px 0;
            color: #907A70;
        }
    </style>
</head>
<body>
    <!-- Thanh điều hướng -->
    <nav>
        <a href="{{ url('/') }}" class="logo">💄 Blog Mỹ Phẩm</a>
        <div class="nav-links">
            <a href="{{ url('/') }}">Trang chủ</a>
            <a href="{{ url('/dang-ky') }}">Đăng ký</a>
        </div>
    </nav>

    <!-- Thông báo lỗi / thành công -->
    @if(session('error'))
        <div class="alert alert-error">• {{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">• {{ session('success') }}</div>
    @endif

    <!-- Form đăng nhập -->
    <div class="login-container">
        <h1>Đăng nhập</h1>
        
        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus>
                @if($errors->has('email'))
                    <p class="error-text">{{ $errors->first('email') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" name="password" required>
                @if($errors->has('password'))
                    <p class="error-text">{{ $errors->first('password') }}</p>
                @endif
            </div>

            <button type="submit" class="btn-login">Đăng nhập</button>
        </form>

        <div class="links">
            <p style="margin-bottom: 15px;">
                <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
            </p>
            <p class="divider">
                Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký ngay</a>
            </p>
        </div>
    </div>
</body>
</html>