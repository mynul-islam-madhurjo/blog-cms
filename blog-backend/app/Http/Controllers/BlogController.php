<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $blog->user_id = Auth::user()->id;
        $blog->image = $imagePath;
        $blog->save();

        return response()->json(['message' => 'Blog post created successfully'], 201);
    }

    public function index(Request $request)
    {
        // I am using the default number 10 as posts per page

        $perPage = $request->query('per_page', 10);

        // Loading the related user model
        $blogs = Blog::with('user')
        ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        // Transform the response to include the user's name
        $transformedBlogs = $blogs->map(function ($blog) {
            return [
                'id' => $blog->id,
                'user_id' => $blog->user_id,
                'user_name' => $blog->user->name, // Include the user's name
                'title' => $blog->title,
                'post' => $blog->post,
                'image' => $blog->image,
                'likes_count' => $blog->likes_count,
                'dislikes_count' => $blog->dislikes_count,
                'comments_count' => $blog->comments_count,
                'created_at' => $blog->created_at,
                'updated_at' => $blog->updated_at,
            ];
        });

        return response()->json($transformedBlogs);
    }

    public function like(Request $request, $blogId)
    {
        $user = auth()->user();

        // Checking if the user has already liked the blog post
        $like = Like::where('user_id', $user->id)->where('post_id', $blogId)->first();

        if ($like) {
            // If user has already liked the post, so unlike it
            $like->delete();
            // Decrement the likes_count in the blogs table
            Blog::where('id', $blogId)->decrement('likes_count');
            return response()->json(['message' => 'Post unliked successfully'], 200);
        }

        // User has not liked the post, so create a new like
        $like = new Like();
        $like->user_id = $user->id;
        $like->post_id = $blogId;
        $like->save();

        // Increment the likes_count in the blogs table
        Blog::where('id', $blogId)->increment('likes_count');

        return response()->json(['message' => 'Post liked successfully'], 200);
    }
    public function getLikesCount($blogId)
    {
        $likesCount = Like::where('post_id', $blogId)->count();

        return response()->json(['likes_count' => $likesCount], 200);
    }

    public function comment(Request $request, $blogId)
    {
        $user = auth()->user();

        $validatedData = $request->validate([
            'content' => 'required',
        ]);

        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->blog_id = $blogId;
        $comment->content = $validatedData['content'];
        $comment->save();

        // Increment the comments count in the blogs table
        Blog::where('id', $blogId)->increment('comments_count');

        return response()->json(['message' => 'Comment added successfully'], 201);
    }

    public function getComments($blogId)
    {
        $comments = Comment::where('blog_id', $blogId)->get();

        return response()->json($comments);
    }

}
