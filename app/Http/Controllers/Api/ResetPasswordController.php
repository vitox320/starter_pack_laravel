<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\ResetCodePassword;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function resetPassword(ResetPasswordRequest $request)
    {
        $passwordReset = ResetCodePassword::where('code', $request->code);

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
