<?php

namespace App\Services;

use App\Repositories\Interfaces\UserInterfaceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserService
{
    /**
     * @param UserInterfaceRepository $repository
     */
    public function __construct(public UserInterfaceRepository $repository)
    {
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $this->repository->store($request->all());
            return response()->json('Registro cadastrado com sucesso', 201);
        } catch (\Exception $exception) {
            return response()->json(['Erro ao salvar usuário'], $exception->getCode());
        }

    }

    public function update(Request $request, int $id)
    {
        try {
            $entity = $this->repository->findById($id);
            $this->repository->update($entity, $request->all());
            return response()->json('Registro atualizado com sucesso');
        } catch (\Exception) {
            return response()->json('Erro ao atualizar registro');
        }
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Credenciais Inválidas'
            ], 401);
        }

        $user = $this->repository->findByEmail($request->email);
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['access_token' => $token, 'token_type' => 'Bearer']);

    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->delete();
    }

}
