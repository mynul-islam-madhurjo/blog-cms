<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    //This method is used for creating the blog

    public function create(Request $request)
    {
        $data = $request->all();
        $validation = Validator::make($data,[
            'title' => 'required|max:255',
            'post' => 'required',
        ]);
        if($validation->fails()){
            return response()->json([
                'error' => $validation->errors()
            ],422);
        }
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->post = $request->post;
        $blog->user_id = $request->user_id;
        $blog->save();

        return response()->json(['message' => 'Blog post created successfully'], 201);
    }
}
