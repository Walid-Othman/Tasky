<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): JsonResponse
    {
        // إذا كان البريد مفعل بالفعل، نرسل رسالة تفيد بذلك بدل التوجيه لصفحة
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email is already verified.'
            ], 200);
        }

        // إرسال الإشعار (الرابط)
        $request->user()->sendEmailVerificationNotification();

        return response()->json([
            'status' => 'verification-link-sent',
            'message' => 'A new verification link has been sent to your email address.'
        ]);
    }
}