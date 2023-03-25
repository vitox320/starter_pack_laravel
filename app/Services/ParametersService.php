<?php

namespace App\Services;

use App\Repositories\Interfaces\ParametersRepositoryInterface;
use Illuminate\Http\Request;

class ParametersService
{
    public function __construct(public ParametersRepositoryInterface $repository)
    {
    }

    public function store(Request $request)
    {
        $this->repository->store($request->all());
        return response()->json('Registro cadastrado com sucesso!', 201);
    }

}
