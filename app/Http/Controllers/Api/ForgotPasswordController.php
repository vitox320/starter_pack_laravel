<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Models\ResetCodePassword;
use App\Notifications\SendCodeResetPassword;


class ForgotPasswordController extends Controller
{
    public function sendCode(ForgotPasswordRequest $request)
    {
        $resetCodePassword = new ResetCodePassword();
        $resetCodePassword->where('email', $request->email)->delete();

        $data = $request->all();
        $data['code'] = mt_rand(100000, 999999);

        $codeData = $resetCodePassword->create($data);
        $resetCodePassword->notify(new SendCodeResetPassword($codeData));

        return response()->json('Código de verificação enviado');
    }
}
