<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse; // تغيير من Redirect إلى Json

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): JsonResponse
    {
        // 1. إذا كان البريد قد تم التحقق منه مسبقاً
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email already verified.'
            ], 200);
        }

        // 2. محاولة تفعيل البريد وإطلاق الحدث
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        // 3. إرجاع رد نجاح للـ API
        return response()->json([
            'message' => 'Email has been verified successfully.'
        ], 200);
    }
}
