<?php

use App\Models\User;
use Illuminate\Support\Str;

uses(Tests\TestCase::class);

it('send code to email', function () {
    $user = User::factory()->create();
    $response = $this->post('/api/auth/forgot-password', ['email' => $user->email]);
    $response->assertOk();
    $response->assertSee('C\u00f3digo de verifica\u00e7\u00e3o enviado');
});

it('verify code', function () {
    $user = User::factory()->create();
    $code = Str::random(6);
    $resetPasswordFactory = \App\Models\ResetCodePassword::factory()->create([
        'email' => $user->email,
        'code' => $code
    ]);
    $response = $this->post('/api/auth/code-check', ['code' => $resetPasswordFactory->code]);

    $response->assertSee('C\u00f3digo V\u00e1lido');
    $response->assertOk();
});

it('reset password', function () {
    $user = User::factory()->create();
    $code = Str::random(6);
    $resetPasswordFactory = \App\Models\ResetCodePassword::factory()->create([
        'email' => $user->email,
        'code' => $code
    ]);
    $responseCodeCheck = $this->post('/api/auth/code-check', ['code' => $resetPasswordFactory->code]);
    $responseContent = json_decode($responseCodeCheck->content());
    $response = $this->post('/api/auth/password-reset', [
        'code' => $responseContent->code,
        "password" => "123456",
        "password_confirmation" => "123456"
    ]);
    $response->assertSee('Senha foi resetada com sucesso!');
    $response->assertOk();
});
