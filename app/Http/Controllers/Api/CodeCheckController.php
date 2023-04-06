<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CodeCheckRequest;
use App\Models\ResetCodePassword;

class CodeCheckController extends Controller
{
    public function verifyCode(CodeCheckRequest $request)
    {
        $passwordReset = ResetCodePassword::where('code', $request->code)->first();

        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response()->json(['message' => 'Código inválido'], 500);
        }

        return response()->json(['code' => $passwordReset->code, 'message' => 'Código Válido']);
    }
}
