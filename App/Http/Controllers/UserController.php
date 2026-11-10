<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegister()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Log::info('Đăng ký tài khoản mới', [
            'email' => $user->email,
            'thoi_gian' => now()
        ]);

        Auth::login($user);
        return redirect()->route('welcome')->with('success', 'Chào mừng bạn! 💄');
    }

    // Hiển thị form đăng nhập
    public function showLogin()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->remember)) {
            $request->session()->regenerate();
            Log::info('Đăng nhập thành công', ['email' => $request->email]);
            return redirect()->route('welcome')->with('success', 'Chào mừng trở lại!');
        }

        Log::warning('Đăng nhập thất bại', ['email' => $request->email]);
        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng'
        ]);
    }

    // Xử lý đăng xuất
    public function logout(Request $request)
    {
        Log::info('Đăng xuất', ['nguoi_dung' => Auth::user()->name ?? 'khách']);
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('welcome');
    }

    // Hiển thị form quên mật khẩu
    public function showForgot()
    {
        return view('auth.forgot-password');
    }

    // Gửi liên kết đặt lại mật khẩu
    public function sendReset(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        Password::sendResetLink($request->only('email'));
        
        return back()->with('status', 'Đã gửi liên kết đặt lại mật khẩu!');
    }

    // Hiển thị form đặt lại mật khẩu
    public function showResetForm($token = null)
    {
        return view('auth.reset-password', compact('token'));
    }

    // Xử lý đặt lại mật khẩu
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ]);

        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
                Auth::login($user);
                Log::info('Đặt lại mật khẩu thành công', ['email' => $user->email]);
            }
        );

        return $response === Password::PASSWORD_RESET
            ? redirect()->route('welcome')->with('success', 'Đặt lại mật khẩu thành công!')
            : back()->withErrors(['email' => 'Liên kết không hợp lệ hoặc đã hết hạn']);
    }
}