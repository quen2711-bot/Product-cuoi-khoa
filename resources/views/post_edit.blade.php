@extends('Layout.master')
@section('title', 'Sửa bài viết')
@section('content')
<div class="container">
    <h2 class="mb-4">✏️ Sửa bài viết</h2>
    
    <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label class="form-label">Tiêu đề bài viết <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nội dung <span class="text-danger">*</span></label>
            <textarea name="content" class="form-control" rows="8" required>{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Danh mục <span class="text-danger">*</span></label>
                <select name="category_id" class="form-select" required>
                    <option value="">Chọn danh mục</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $post->category_id) == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Thẻ</label>
                <select name="tags[]" class="form-select" multiple size="4">
                    @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                        {{ $tag->name }}
                    </option>
                    @endforeach
                </select>
                <small class="text-muted">Giữ Ctrl để chọn nhiều</small>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Ảnh hiện tại</label>
            @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" class="img-thumbnail d-block mb-2" style="max-height: 200px;">
            @else
            <p class="text-muted">Chưa có ảnh</p>
            @endif
            <input type="file" name="image" class="form-control" accept="image/*">
            <small class="text-muted">Để trống nếu không muốn đổi ảnh</small>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Trạng thái <span class="text-danger">*</span></label>
                <select name="status" class="form-select" required>
                    <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Bản nháp</option>
                    <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Đăng ngay</option>
                    <option value="scheduled" {{ old('status', $post->status) == 'scheduled' ? 'selected' : '' }}>Hẹn giờ đăng</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Thời gian hẹn đăng</label>
                <input type="datetime-local" name="scheduled_at" class="form-control" 
                       value="{{ old('scheduled_at', $post->scheduled_at ? $post->scheduled_at->format('Y-m-d\TH:i') : '') }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật bài viết</button>
        <a href="{{ route('post.show', $post->slug) }}" class="btn btn-light">Hủy</a>
    </form>
</div>
@endsection