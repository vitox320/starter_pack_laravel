<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @param UserService $service
     */
    public function __construct(public UserService $service)
    {
    }

    public function login(LoginRequest $request)
    {
        return $this->service->login($request);
    }

    public function register(UserRequest $request)
    {
        return $this->service->store($request);
    }

    public function me(Request $request)
    {
        return $this->service->me($request);
    }

    public function logout(Request $request)
    {
        $this->service->logout($request);
    }
}
