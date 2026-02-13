<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordResetLinkController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        
        $otp = rand(100000, 999999);

       
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                
                'token' => Hash::make($otp), 
                'created_at' => now()
            ]
        );

       
        Mail::raw("كود إعادة تعيين كلمة المرور الخاص بك هو: $otp", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('كود إعادة تعيين كلمة المرور');
        });

        return response()->json([
            'message' => 'تم إرسال كود التحقق إلى بريدك الإلكتروني.'
        ]);
    }
}