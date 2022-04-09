<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


// 手動加入
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        $faileds = $request -> validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);
        $user = User::create([
            'name' => $faileds['name'],
            'email' => $faileds['email'],
            'password' => bcrypt($faileds['password'])
        ]);
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token,
        ];
        return response($response,201);
    }

    public function login(Request $request){
        $faileds = $request -> validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        // Check Email
        $user = User::where('email', $faileds['email'])->first();
        // Check password
        if(!$user|!Hash::check($faileds['password'],$user->password)){
            return response([
                'message' => 'Bad creds'
            ],401);
        }
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token,
        ];
        return response($response,201);
    }

    public function logout() {
        auth()->user()->tokens()->delete();

        return[
            'message' => 'Logged out',
        ];
    }
}
