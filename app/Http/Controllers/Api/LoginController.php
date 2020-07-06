<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function auth( Request $request)
    {
        $tokenExp = $this->tokenExp( $request->isAdmin);
        $credentials = $request->only(['email', 'password']);

        Validator::make( $credentials, [
            'email' => 'required|string',
            'password' => 'required|string'
        ])->validate();

        if( !$token = Auth::guard('api')->setTTL( $tokenExp)->attempt($credentials)) {
            $message = ['Unauthorized'];
            return response()->json( $message, 401);
        }
        return $this->respondWithToken( $token);
    }

    public function logout()
    {
        Auth::guard('api')->logout();
        return response()->json(['message'=>'Logout']);
    }
    
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL()
        ]);
    }
}
