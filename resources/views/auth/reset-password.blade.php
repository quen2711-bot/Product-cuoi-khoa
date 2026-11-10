@extends('Layout.master')
@section('title', 'Đặt lại mật khẩu')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <h2 class="mb-4">Đặt lại mật khẩu mới</h2>

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $email ?? old('email') }}" required readonly>
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Mật khẩu mới</label>
                <input type="password" name="password" class="form-control" required>
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nhập lại mật khẩu mới</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Lưu mật khẩu mới</button>
        </form>
    </div>
</div>
@endsection