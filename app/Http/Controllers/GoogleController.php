<?php

namespace App\Http\Controllers;

use App\Services\GoogleServices;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class GoogleController extends Controller
{
    protected $googleServices;
    public function __construct(GoogleServices $googleServices)
    {
        $this->googleServices = $googleServices;
    }

   public  function googleRedirect(){
        try{
         return $this->googleServices->redirectGoogle();
        }catch(
            \Exception $e
        ){
           return response()->json([
            'status'=>false,
            'message'=>$e->getMessage(),
           ]);
        }
     }


     public function googleCallBack(Request $request){
        try{
            $user = $this->googleServices->callBackGoogle($request);
            return response()->json([
                'success'=>true,
                'message'=>'register successfully',
                'user'=>$user,
                'token'=>$user['token']
            ]);
        }catch(\Exception $e){
           return response()->json([
            'status'=>false,
            'message'=>$e->getMessage()
           ]);
        }
     }




}
