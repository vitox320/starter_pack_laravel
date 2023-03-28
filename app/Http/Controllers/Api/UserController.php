<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param UserService $service
     */
    public function __construct(public UserService $service)
    {
    }

    public function filter(Request $request)
    {
        return $this->service->filter($request);
    }

    public function update(Request $request, int $id)
    {
        return $this->service->update($request, $id);
    }

    public function store(UserRequest $request)
    {
        return $this->service->store($request);
    }

}
