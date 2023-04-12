<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CodeCheckRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\ResetCodePassword;
use App\Models\User;
use App\Notifications\SendCodeResetPassword;
use App\Services\ForgotPasswordService;


class ForgotPasswordController extends Controller
{
    public function __construct(public ForgotPasswordService $service)
    {
    }

    public function sendCode(ForgotPasswordRequest $request)
    {
        return $this->service->sendCode($request->all());
    }

    public function verifyCode(CodeCheckRequest $request)
    {
        return $this->service->verifyCode($request);

    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        return $this->service->resetPassword($request);
    }


}
