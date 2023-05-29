<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // This function is used for user registration
    public function register(Request $request)
    {
        $data = $request->all();

        $validation = Validator::make($data,[
            'email' =>'required|email|unique:users,email',
            'password' =>'required',
            'name' =>'required|string'
        ]);
        if($validation->fails()){
            return response()->json([
                'errors'=>$validation->errors()
            ],422);
        }
        try {
            $data['password'] = Hash::make($request->password);
            User::create($data);
            return response()->json([
                'message' => 'Successfully registered!'
            ],201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Something went wrong '.$e->getMessage()
            ],$e->getCode());
        }

    }
}
