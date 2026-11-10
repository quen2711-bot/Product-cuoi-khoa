<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;

// === TRANG CÔNG KHAI ===
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/blog', [WelcomeController::class, 'blog'])->name('blog');
Route::get('/bai-viet/{slug}', [WelcomeController::class, 'show'])->name('post.show');

// === TÀI KHOẢN ===
Route::get('/dang-ky', [UserController::class, 'showRegister'])->name('register');
Route::post('/dang-ky', [UserController::class, 'register']);

Route::get('/dang-nhap', [UserController::class, 'showLogin'])->name('login');
Route::post('/dang-nhap', [UserController::class, 'login']); // ✅ Đúng đường dẫn

Route::post('/dang-xuat', [UserController::class, 'logout'])->name('logout');

Route::get('/quen-mat-khau', [UserController::class, 'showForgot'])->name('password.request');
Route::post('/quen-mat-khau', [UserController::class, 'sendReset'])->name('password.email');
Route::get('/dat-lai-mat-khau/{token}', [UserController::class, 'showResetForm'])->name('password.reset');
Route::post('/dat-lai-mat-khau', [UserController::class, 'reset'])->name('password.update');

// === BÀI VIẾT — CẦN ĐĂNG NHẬP ===
Route::middleware('auth')->group(function () {
    Route::get('/bai-viet-cua-toi', [PostController::class, 'index'])->name('post.index');
    Route::get('/viet-bai', [PostController::class, 'create'])->name('post.create');
    Route::post('/viet-bai', [PostController::class, 'store'])->name('posts.store');
    Route::get('/sua-bai/{post}', [PostController::class, 'edit'])->name('post.edit');
    Route::post('/sua-bai/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/xoa-bai/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/khoi-phuc-bai/{id}', [PostController::class, 'restore'])->name('posts.restore');
    Route::delete('/xoa-vinh-vien/{id}', [PostController::class, 'forceDelete'])->name('posts.forceDelete');
});

// === BÌNH LUẬN ===
Route::post('/binh-luan/{post}', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/binh-luan/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

// === QUẢN TRỊ ===
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/danh-muc', [AdminController::class, 'categoriesIndex'])->name('categories.index');
    Route::post('/danh-muc', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::post('/danh-muc/{category}', [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/danh-muc/{category}', [AdminController::class, 'deleteCategory'])->name('categories.destroy');
    Route::get('/bai-viet', [AdminController::class, 'allPosts'])->name('posts.all');
});