<?php
uses(Tests\TestCase::class);

it('send code to email', function () {
    $user = \App\Models\User::factory()->create();
    $response = $this->post('/api/auth/forgot-password', ['email' => $user->email]);
    $response->assertOk();
    $response->assertSee('C\u00f3digo de verifica\u00e7\u00e3o enviado');
});

it('verify code', function () {
    $user = \App\Models\User::factory()->create();
    $code = mt_rand(100000, 999999);
    $resetPasswordFactory = \App\Models\ResetCodePassword::factory()->create([
        'email' => $user->email,
        'code' => $code
    ]);
    $response = $this->post('/api/auth/code-check', ['code' => $resetPasswordFactory->code]);
    $response->assertSee('Código Válido');
    $response->assertOk();
});

//it('reset password', function () {
//
//});
