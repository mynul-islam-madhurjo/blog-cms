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

    public function login(Request $request)
    {   $data = $request->all();

        $validation = Validator::make($data,[
            'email' =>'required|email',
            'password' =>'required',
        ]);
        if($validation->fails()){
            return response()->json([
                'error' => $validation->errors()
            ],422);
        }

        $credentials = $request->only('email','password'); // for security
        if(Auth::attempt($credentials)){

            $user = Auth::user();

            $data['id'] = $user->id;
            $data['email'] = $user->email;
            $data['access_token'] = $user->createToken('accessToken')->accessToken;
            return response()->json([
                'message' =>'Successfully logged in',
                'data'=>$data

            ],200);
        }
        return response()->json([
            'message' => 'Invalid email or password'
        ],401);
    }

    public function logout(Request $request){
        $user = Auth::guard('api')->user();
        if ($user) {
            $user->token()->revoke(); // Revoke the user's token
        }
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }


}
