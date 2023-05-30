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
            // Assuming media is an image file
            'image' => 'nullable|mimes:jpeg,png|max:2048',
        ]);
        if($validation->fails()){
            return response()->json([
                'error' => $validation->errors()
            ],422);
        }

        // Handling for image upload (if any)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('image');
        } else {
            $imagePath = null;
        }

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->post = $request->post;
        $blog->user_id = $request->user_id;
        $blog->image = $request->$imagePath;
        $blog->save();

        return response()->json(['message' => 'Blog post created successfully'], 201);
    }

    public function index(Request $request)
    {
        // I am using the default number 10 number os posts per page

        $perPage = $request->query('per_page', 10);

        $blogs = Blog::orderBy('created_at', 'desc')->paginate($perPage);

        return response()->json($blogs);
    }
}
