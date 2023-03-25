<?php

namespace App\Services;

use App\Repositories\Interfaces\ProfileRepositoryInterface;
use Illuminate\Http\Request;

class ProfileService
{
    public function __construct(public ProfileRepositoryInterface $repository)
    {
    }

    public function store(Request $request)
    {
        try {
            $this->repository->store($request->all());
            return response()->json('Registro cadastrado com sucesso!', 201);
        } catch (\Exception) {
            return response()->json('Erro ao cadastrar registro');
        }

    }

    public function update(Request $request, int $id)
    {
        try {
            $profile = $this->repository->findById($id);
            $this->repository->update($profile, $request->all());
            return response()->json('Registro atualizado com sucesso!');
        } catch (\Exception) {
            return response()->json('Erro ao atualizar registro');
        }

    }

    public function getProfileAbilities($id)
    {
        $profile = $this->repository->findById($id);
        $profile_abilities = $this->repository->getProfileAbilities($profile);
        return $this->repository->getSlugsProfileAbilities($profile_abilities);


    }


}
