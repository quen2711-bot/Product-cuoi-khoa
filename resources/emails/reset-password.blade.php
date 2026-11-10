<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Đặt lại mật khẩu</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #e91e63;">Đặt lại mật khẩu 🔑</h2>
        <p>Bạn nhận được email này vì chúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.</p>
        <p>Nhấn nút bên dưới để đặt lại mật khẩu:</p>
        <p style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/reset-password/' . $token . '?email=' . urlencode($email)) }}" 
               style="background: #e91e63; color: white; padding: 12px 30px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                Đặt lại mật khẩu
            </a>
        </p>
        <p>Nếu bạn không yêu cầu này, vui lòng bỏ qua email này.</p>
        <p>Liên kết hết hạn sau 60 phút.</p>
    </div>
</body>
</html>