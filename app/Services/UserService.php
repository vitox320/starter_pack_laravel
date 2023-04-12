<?php

namespace App\Services;

use App\Repositories\Interfaces\ParametersRepositoryInterface;
use App\Repositories\Interfaces\ProfileRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use MongoDB\Driver\Exception\AuthenticationException;

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
            return response()->json(['message' => 'Registro cadastrado com sucesso'], 201);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Erro ao salvar usuário'], $exception->getCode());
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
            return response()->json(['message' => 'Registro atualizado com sucesso']);
        } catch (\Exception) {
            return response()->json(['message' => 'Erro ao atualizar registro']);
        }
    }

    public function login(Request $request)
    {
        try {
            $user = $this->repository->findByEmail($request->email);

            if (!Hash::check($request->password, $user->password)) {
                throw new \Exception('Credenciais Inválidas', 401);
            }

            $profile = $this->profileRepository->findById($user->profile_id);
            $profile_abilities = $this->profileRepository->getProfileAbilities($profile);
            $abilities = $this->profileRepository->getSlugsProfileAbilities($profile_abilities);

            $token = $user->createToken('auth_token', $abilities)->plainTextToken;
            return response()->json(['message' => 'Login realizado com sucesso!', 'access_token' => $token, 'token_type' => 'Bearer']);
        } catch (\Exception) {
            return response()->json(['message' => 'Erro no login'], 401);
        }


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
