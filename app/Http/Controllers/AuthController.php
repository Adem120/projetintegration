<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register','logout']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $r)
    {
    $r->validate([
        'email'=>'required|email',
        'password'=>'required'
    ]);
    $credentials = $r->only('email', 'password');
       

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'aaaa'], 401);
        }

        return $this->respondWithToken($token);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    public function register(Request $r){
        $r->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
            'role'=>'required'

        ]);
        $user=User::create([
            'name'=>$r->name,
            'email'=>$r->email,
            'password'=>Hash::make($r->password),
            'role'=>$r->role
        ]);
        $token=JWTAuth::fromUser($user);
        return response()->json(['user'=>$user,'token'=>$token],201);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}