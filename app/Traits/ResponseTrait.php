<?php

namespace App\Traits;

trait ResponseTrait
{
    public function response(bool $success,string  $message = '' , mixed $data,int $code = 200){
        return response()->json([
            'success'=> $success,
            'message'=>$message,
            'data'=>$data,
        ],$code);
    }
}
