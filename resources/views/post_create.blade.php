@extends('Layout.master')
@section('title', 'Viết bài mới')
@section('content')
<div class="container">
    <h2 class="mb-4">✍️ Viết bài mới</h2>
    
    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label class="form-label">Tiêu đề bài viết <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nội dung <span class="text-danger">*</span></label>
            <textarea name="content" class="form-control" rows="8" required>{{ old('content') }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Danh mục <span class="text-danger">*</span></label>
                <select name="category_id" class="form-select" required>
                    <option value="">Chọn danh mục</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Thẻ</label>
                <select name="tags[]" class="form-select" multiple size="4">
                    @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
                        {{ $tag->name }}
                    </option>
                    @endforeach
                </select>
                <small class="text-muted">Giữ Ctrl để chọn nhiều</small>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Ảnh minh họa</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Trạng thái <span class="text-danger">*</span></label>
                <select name="status" class="form-select" required>
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Bản nháp</option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Đăng ngay</option>
                    <option value="scheduled" {{ old('status') == 'scheduled' ? 'selected' : '' }}>Hẹn giờ đăng</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Thời gian hẹn đăng</label>
                <input type="datetime-local" name="scheduled_at" class="form-control" value="{{ old('scheduled_at') }}">
                <small class="text-muted">Chỉ dùng khi chọn hẹn giờ</small>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Lưu bài viết</button>
        <a href="{{ route('post.index') }}" class="btn btn-light">Hủy</a>
    </form>
</div>
@endsection