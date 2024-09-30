<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Location;

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
    
    public function create()
    {
        $locations = Location::all(); // 全てのロケーションを取得
        return view('posts.create')->with(['locations' => $locations]);
    }
    
    public function store(Request $request, Post $post)
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
}

