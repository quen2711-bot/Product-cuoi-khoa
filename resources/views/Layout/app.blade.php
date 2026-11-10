<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Stories & Ideas')</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f6f8;
            color: #252b33;
        }

        a {
            text-decoration: none;
        }

        .container {
            max-width: 1150px;
            margin: auto;
            padding: 25px 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            background: #286b83;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn:hover {
            background: #194d61;
        }

        .card {
            background: white;
            padding: 22px;
            border: 1px solid #e5e7eb;
            border-radius: 9px;
        }

        .field {
            display: block;
            width: 100%;
            padding: 11px;
            margin: 8px 0 18px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font: inherit;
        }

        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            background: #e4f6e9;
            color: #216b38;
        }

        .error {
            color: #c62828;
            margin-top: -12px;
            margin-bottom: 15px;
        }

        @media (max-width: 600px) {
            .container {
                padding: 18px 12px;
            }
        }
    </style>
</head>
<body>
    @include('Layout.header')

    @yield('content')

    @include('Layout.footer')
</body>
</html>