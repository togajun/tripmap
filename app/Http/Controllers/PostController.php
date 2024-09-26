<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Post;

class PostController extends Controller
{
    public function index(Post $post)//インポートしたPostをインスタンス化して$postとして使用。
    {
        return view('posts.index')->with(['posts'->get()]);//$postの中身を戻り値にする。
    }
    
    public function create()
    {
        return view('posts.create');
    }
}

