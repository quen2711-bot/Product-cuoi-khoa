@extends('Layout.master')
@section('title', 'Đăng ký')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <h2 class="mb-4">Đăng ký tài khoản</h2>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Họ tên</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Mật khẩu</label>
                <input type="password" name="password" class="form-control" required>
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nhập lại mật khẩu</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Đăng ký</button>

            <p class="mt-3 text-center">
                Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a>
            </p>
        </form>
    </div>
</div>
@endsection