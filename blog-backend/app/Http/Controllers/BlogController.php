<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = User::all();
        return response()->json($data);
    }
}
