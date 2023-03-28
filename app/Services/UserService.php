<?php

namespace App\Services;

use App\Repositories\Interfaces\ParametersRepositoryInterface;
use App\Repositories\Interfaces\ProfileRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserService
{
    /**
     * @param UserRepositoryInterface $repository
     * @param ProfileRepositoryInterface $profileRepository
     */
    public function __construct(
        public UserRepositoryInterface       $repository,
        public ProfileRepositoryInterface    $profileRepository,
        public ParametersRepositoryInterface $parametersRepository)
    {
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        try {
            if ($request->path() == 'api/auth/register') {
                $data['profile_id'] = $this->parametersRepository->getParametersValueByParameterName('COLABORADOR_PROFILE');
            }
            $this->repository->store($data);
            return response()->json('Registro cadastrado com sucesso', 201);
        } catch (\Exception $exception) {
            return response()->json(['Erro ao salvar usuário'], $exception->getCode());
        }

    }

    public function filter(Request $request)
    {
        return $this->repository->filter($request->all());
    }

    public function findById(int $id)
    {
        return $this->repository->findById($id);
    }

    public function update(Request $request, int $id)
    {
        try {
            $entity = $this->findById($id);
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
        $profile = $this->profileRepository->findById($user->profile_id);
        $profile_abilities = $this->profileRepository->getProfileAbilities($profile);
        $abilities = $this->profileRepository->getSlugsProfileAbilities($profile_abilities);

        $token = $user->createToken('auth_token', $abilities)->plainTextToken;
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
