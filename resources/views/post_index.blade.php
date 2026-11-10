@extends('Layout.master')
@section('title', 'Bài viết của tôi')
@section('content')
<div>
    <h2>📝 Bài viết của tôi</h2>
    <a href="{{ route('post.create') }}" class="btn btn-primary" style="margin-bottom: 25px;">+ Viết bài mới</a>

    @if($posts->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Danh mục</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr class="{{ $post->deleted_at ? 'table-secondary' : '' }}">
                        <td>
                            @if($post->deleted_at)
                                {{ $post->title }}
                            @else
                                <a href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a>
                            @endif
                        </td>
                        <td>{{ $post->category->name }}</td>
                        <td>
                            @if($post->deleted_at)
                                <span class="badge bg-danger">Đã xóa</span>
                            @elseif($post->status == 'published')
                                <span class="badge bg-success">Đã đăng</span>
                            @elseif($post->status == 'scheduled')
                                <span class="badge bg-warning">Hẹn giờ</span>
                            @else
                                <span class="badge bg-secondary">Bản nháp</span>
                            @endif
                        </td>
                        <td>{{ $post->created_at->format('d/m/Y') }}</td>
                        <td>
                            @if(!$post->deleted_at)
                                <a href="{{ route('post.edit', $post) }}" class="btn btn-warning" style="padding: 6px 12px; font-size: 13px;">Sửa</a>
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa bài viết này?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger" style="padding: 6px 12px; font-size: 13px;">Xóa</button>
                                </form>
                            @else
                                <a href="{{ route('posts.restore', $post->id) }}" class="btn btn-primary" style="padding: 6px 12px; font-size: 13px;">Khôi phục</a>
                                <form action="{{ route('posts.forceDelete', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa vĩnh viễn? Không thể hoàn tác!')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger" style="padding: 6px 12px; font-size: 13px;">Xóa vĩnh viễn</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="text-center" style="padding: 60px 20px; color: #907A70;">