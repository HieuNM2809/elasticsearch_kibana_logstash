<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    public function home (Request $request) {
        $posts = Post::all();

        return view('home', ['posts' => $posts]);
    }
}
