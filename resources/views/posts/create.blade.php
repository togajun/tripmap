<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Tripmap - Create Post</title>
        {{-- Google Fonts --}}
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
        
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            h1 {
                font-size: 36px;
                color: #333;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
                margin-top: 20px;
            }

            form {
                background-color: white;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                width: 80%;
                max-width: 600px;
                margin-top: 20px;
            }

            label {
                font-weight: bold;
                margin-top: 10px;
                display: block;
            }

            input[type="text"],
            textarea,
            select {
                width: 100%;
                padding: 10px;
                margin-top: 5px;
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 5px;
                font-size: 16px;
            }

            input[type="file"] {
                margin-bottom: 15px;
            }

            input[type="submit"] {
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
                transition: background-color 0.3s ease;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            }

            input[type="submit"]:hover {
                background-color: #45a049;
            }

            .footer a {
                text-decoration: none;
                color: white;
                background-color: #4CAF50;
                padding: 10px 20px;
                border-radius: 5px;
                margin-top: 10px;
                display: inline-block;
                transition: background-color 0.3s ease;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            }

            .footer a:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>
        <h1>Tripmap -Create a New Post</h1>
        <form action="/posts" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="locations">
                <label for="location">Prefecture</label>
                <select name="post[location_id]" id="location">
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="title">
                <label for="title">Location</label>
                <input type="text" id="title" name="post[title]" placeholder="タイトルを入力してください"/>
            </div>

            <div class="body">
                <label for="body">Body</label>
                <textarea id="body" name="post[body]" placeholder="本文を入力してください"></textarea>
            </div>

            <div class="category">
                <label for="category">Category</label>
                <select name="post[category_id]" id="category">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="image">
                <label for="image">Upload Image</label>
                <input type="file" id="image" name="image">
            </div>

            <input type="submit" value="Submit Post"/>
        </form>

        <div class="footer">
            <a href="/posts">Back to Posts</a>
        </div>
    </body>
</html>
