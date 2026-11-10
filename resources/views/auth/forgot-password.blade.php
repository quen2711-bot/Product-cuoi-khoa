@extends('Layout.master')
@section('title', 'Quên mật khẩu')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <h2 class="mb-4">Quên mật khẩu</h2>

        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email đăng ký</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Gửi liên kết đặt lại mật khẩu</button>
        </form>

        <p class="mt-3 text-center">
            <a href="{{ route('login') }}">Quay lại đăng nhập</a>
        </p>
    </div>
</div>
@endsection