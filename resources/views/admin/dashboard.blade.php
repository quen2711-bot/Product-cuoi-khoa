@extends('Layout.master')
@section('title', 'Trang quản trị')
@section('content')
<div class="container">
    <h2 class="mb-4">📊 Bảng thống kê</h2>
    
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Tổng thành viên</h5>
                    <h3>{{ $soThanhVien }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Bài đã đăng</h5>
                    <h3>{{ $soBaiDang }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5>Tổng bình luận</h5>
                    <h3>{{ $soBinhLuan }}</h3>
                </div>
            </div>
        </div>
    </div>

    <h4>🏆 5 bài viết nhiều bình luận nhất</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tiêu đề</th>
                <th>Tác giả</th>
                <th>Số bình luận</th>
            </tr>
        </thead>
        <tbody>
            @foreach($topBaiViet as $bai)
            <tr>
                <td>{{ $bai->title }}</td>
                <td>{{ $bai->user->name }}</td>
                <td>{{ $bai->comments_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.categories.index') }}" class="btn btn-warning">Quản lý danh mục</a>
    <a href="{{ route('admin.posts.all') }}" class="btn btn-secondary">Tất cả bài viết</a>
</div>
@endsection