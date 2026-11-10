@extends('Layout.master')
@section('title', 'Quản lý danh mục')
@section('content')
<div class="container">
    <h2 class="mb-4">📁 Quản lý danh mục</h2>
    
    <form method="POST" action="{{ route('admin.categories.store') }}" class="mb-4">
        @csrf
        <div class="input-group">
            <input type="text" name="name" class="form-control" placeholder="Tên danh mục mới" required>
            <button class="btn btn-primary">Thêm</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($danhMucs as $dm)
            <tr>
                <td>{{ $dm->name }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.categories.update', $dm->id) }}" class="d-inline">
                        @csrf
                        <input type="text" name="name" value="{{ $dm->name }}" required>
                        <button class="btn btn-sm btn-success">Sửa</button>
                    </form>
                    <form method="POST" action="{{ route('admin.categories.destroy', $dm->id) }}" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-light">← Quay lại</a>
</div>
@endsection