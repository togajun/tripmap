<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Tripmap</title>
    </head>
    <body>
        <h1>Tripmap</h1>
        <form action="/posts" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="locations">
                <h2>Prefecture</h2>
                <select name="post[location_id]">
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="title">
                <h2>location</h2>
                <input type="text" name="post[title]" placeholder="タイトル"/>
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="post[body]" placeholder="本文"></textarea>
            </div>
            <div class="category">
                <h2>Category</h2>
                <select name="post[category_id]">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="image">
                <input type="file" name="image">
            </div>
            <input type="submit" value="check"/>
        </form>
        <div class="footer">
            <a href="/posts">戻る</a>
        </div>
    </body>
</html>