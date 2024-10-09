<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Tripmap</title>
        {{-- Google Fonts --}}
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
        {{-- Leaflet CSS --}}
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
        {{-- Leaflet JavaScript --}}
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script> 
        <style>
            body {
                font-family: 'Poppins', sans-serif; /* タイトル用にGoogle FontsのPoppinsを使用 */
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            h1 {
                font-size: 48px;
                color: #333;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1); /* 影を追加して強調 */
                margin-top: 20px;
            }

            #map {
                background-color: #87CEEB; /* 海の色（スカイブルー） */
                height: 750px;
                width: 90%;
                border: 3px solid #333; /* 地図の周りにボーダー */
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* 影を追加して立体感を演出 */
                margin-top: 20px;
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
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* ボタンにも影を追加 */
            }
            
            a:hover {
                background-color: #45a049;
            }

        </style>
        <script src="{{ asset('js/Map/map.js') }}" defer></script>
    </head>
    <body>
        <h1>Tripmap</h1>
        <div id="map"></div>
        <a href='/posts/create'>Create New Post</a>
    </body>
</html>