<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tripmap</title>

        <!-- Google Fonts -->
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <style>
            body {
                font-family: 'Figtree', sans-serif;
                margin: 0;
                padding: 0;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                background: linear-gradient(135deg, #87CEEB, #FFFFFF); /* グラデーション背景 */
                overflow: hidden; /* 画面外にはみ出す部分を非表示 */
            }

            .content {
                text-align: center;
                z-index: 10; /* シルエットより前面に表示 */
            }

            h1 {
                font-size: 48px;
                color: #333;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            }

            a {
                display: inline-block;
                text-decoration: none;
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                border-radius: 5px;
                margin-top: 20px;
                font-size: 16px;
                transition: background-color 0.3s ease;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            }

            a:hover {
                background-color: #45a049;
            }

            .airplane, .train {
                position: absolute;
                opacity: 0.1; /* シルエットを目立たせすぎない */
            }

            .airplane {
                top: 20px;
                right: 20px;
                width: 300px;
                transform: rotate(10deg);
            }

            .train {
                bottom: 10px;
                right: 20px;
                width: 300px;
            }
        </style>
    </head>
    <body>
        <div class="content">
            <h1>Welcome to Tripmap</h1>
            <p>Your personalized travel map experience starts here.</p>
            <a href="{{ route('login') }}">Log in</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" style="margin-left: 10px;">Register</a>
            @endif
        </div>

        <!-- シルエットの画像 -->
        <img src="{{ asset('images/airplane.png') }}" alt="Airplane" class="airplane">
        <img src="{{ asset('images/train.jpg') }}" alt="Train" class="train">
    </body>
</html>
