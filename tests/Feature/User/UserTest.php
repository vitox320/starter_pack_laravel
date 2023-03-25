<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

uses(Tests\TestCase::class);

it('can create a user', function () {
    $profile = \App\Models\Profile::factory()->create();
    $userRequest = [
        'name' => 'Victor xD',
        'email' => 'zaaw320@gmail.com',
        'password' => '123456',
        'password_confirmation' => '123456',
        'profile_id' => $profile->id
    ];

    $response = $this->post('/api/auth/register', $userRequest);

    expect($response->status())->toBe(201);
    $response->assertSee('Registro cadastrado com sucesso');

});

it('can login', function () {
    $user = \App\Models\User::factory()->create();

    $userRequest = [
        'email' => $user->email,
        'password' => 'password'
    ];
    $response = $this->post('/api/auth/login', $userRequest);
    expect($response->status())->toBe(200);
    $response->json('access_token');
    $response->json('token_type');
});

it('can get auth me', function () {
    $user = User::factory()->create();
    Sanctum::actingAs(
        $user,
        ['*']
    );

    $response = $this->post('api/auth/me');
    expect($user->name)->toBe($response->json('name'))
        ->and($user->email)->toBe($response->json('email'))
        ->and($user->profile_id)->toBe($response->json('profile_id'));
});
