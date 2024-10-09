<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Location;
use App\Models\Category;
use Cloudinary;

class PostController extends Controller
{
    public function index(Post $post)//インポートしたPostをインスタンス化して$postとして使用。
    {
        return view('posts.index');
    }
    
    public function getGeoJson()
    {
        $geoJson = file_get_contents(public_path('geojson/japan.geojson'));

        // デコードされたオブジェクトは連想配列形式
        $decoded_geoJson = json_decode($geoJson, true);

        // 各都道府県を参照渡しで回す
        foreach ($decoded_geoJson['features'] as &$feature) {
            $prefectureId = $feature['properties']['pref'];
            $post = Post::where('location_id', $prefectureId)->first();


            // 新しい要素を追加
            if ($post) {
                $feature['properties'] += [
                    'picture' => $post->picture
                ];
            }
        }

        return response()->json($decoded_geoJson);
    }
    
    public function getPosts() 
    {   // 必要なデータだけを返す（例: location_idとimage_path）
        $posts = Post::select('location_id', 'image_path')->get();
        return response()->json($posts);
    }
    
    public function create()
    {
        $locations = Location::all(); // 
        $categories = Category::all();
        return view('posts.create')->with([
            'locations' => $locations,
            'categories' => $categories
        ]);
    }
    
    public function store(Request $request, Post $post)
    {
        $input = $request['post'];
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $input += [
            'image_path' => $image_url, 
            'user_id' => auth()->id(), 
            'category_id' => $request->input('post.category_id'), 
            'location_id' => $request->input('post.locations_id')
        ];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
        //'post'はbladeファイルで使う変数。中身は$postはid=1のPostインスタンス。
    }
}

