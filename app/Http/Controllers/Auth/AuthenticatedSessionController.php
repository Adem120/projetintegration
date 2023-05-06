<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Responses\ResponseJson;


class AuthenticatedSessionController extends Controller
{
   
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request){

    $validator= $request->validate([
        'email'=>'required|email',
      'password'=>'required|min:6'
      ]);

if(!$token=auth()->attempt($validator)){
  return response()->json(['error'=>'Email or paasword not correct'],401);
}
return $this->createNewToken($token);
}
public function createNewToken($token){
  return response()->json([
      'access_token'=>$token,
      'token_type'=>'bearer',
      'user'=>auth()->user()
  ]);

}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
