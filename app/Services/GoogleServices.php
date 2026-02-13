<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;


class GoogleServices {
 public function redirectGoogle(){
    return Socialite::driver('google')->stateless()->redirect();
 }


 public function callBackGoogle(Request $request){
  
   if ($request->has('access_token')) {
        $googleUser = Socialite::driver('google')->stateless()->userFromToken($request->access_token);
    } 

    else {
        $googleUser = Socialite::driver('google')->stateless()->user();
    }
   //  $googleUser = Socialite::driver('google')->stateless()->user();
    $user = User::updateOrCreate(
        ['email'=>$googleUser->email],
        
    [
     'name' =>$googleUser->name,
     'google_id' =>$googleUser->id,
     'password' => bcrypt(rand(1000,9999)),
     'email_verified_at'=>now(),
     
     ] );
     $token = $user->createToken('Auth_Token')->plainTextToken;
  return ['user'=> $user ,'token'=> $token];
 }
}