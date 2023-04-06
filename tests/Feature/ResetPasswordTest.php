<?php
uses(Tests\TestCase::class);

it('send code to email', function () {
    $user = \App\Models\User::factory()->create();
    $response = $this->post('/api/auth/forgot-password', ['email' => $user->email]);
    $response->assertOk();
    $response->assertSee('C\u00f3digo de verifica\u00e7\u00e3o enviado');
});
