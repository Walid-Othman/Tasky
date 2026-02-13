<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{

use ResponseTrait;
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
         if(!Auth::attempt($request->only('email','password'))){
            return $this->response(false,"Wrong email or password",null,401);
         }
         $user = Auth::user();
         /** @var \App\Models\User $user */
         $user->token = $user->createToken('user_token')->plainTextToken;
         return $this->response(true,"Logged in successfully",new UserResource($user),200);
      
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->response(true,"Logged out successfully",null,200);
    }
}
