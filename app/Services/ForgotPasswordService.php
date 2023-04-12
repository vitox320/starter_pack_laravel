<?php

namespace App\Services;

use App\Http\Requests\CodeCheckRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\ResetCodePassword;
use App\Models\User;
use App\Notifications\SendCodeResetPassword;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class ForgotPasswordService
{
    public function __construct(public UserRepositoryInterface $userRepository)
    {
    }

    public function sendCode(array $data)
    {
        $resetCodePassword = new ResetCodePassword();
        $resetCodePassword->where('email', $data['email'])->delete();

        $data['code'] = mt_rand(100000, 999999);

        $codeData = $resetCodePassword->create($data);
        $resetCodePassword->notify(new SendCodeResetPassword($codeData));

        return response()->json(['message' => 'Código de verificação enviado']);
    }

    public function verifyCode(Request $request)
    {
        $passwordReset = ResetCodePassword::where('code', $request->code)->first();

        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response()->json(['message' => 'Código inválido'], 500);
        }

        return response()->json(['code' => $passwordReset->code, 'message' => 'Código Válido']);
    }

    public function resetPassword(Request $request)
    {
        $passwordReset = ResetCodePassword::query()->where('code', $request->code)->orderBy('created_at', 'desc')->first();

        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response()->json(['message' => 'Código inválido']);
        }

        $user = User::firstWhere('email', $passwordReset->email);
        $user->update($request->only('password'));
        $passwordReset->delete();

        return response()->json(['message' => 'Senha foi resetada com sucesso!']);
    }


}
