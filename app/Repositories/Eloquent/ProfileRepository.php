<?php

namespace App\Repositories\Eloquent;

use App\Models\Profile;
use App\Repositories\Interfaces\ProfileRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ProfileRepository implements ProfileRepositoryInterface
{
    public function __construct(public Profile $entity)
    {
    }

    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->entity::all();
    }

    public function filter(array $data): LengthAwarePaginator
    {
        $query = $this->entity::query();
        if (isset($data['name'])) {
            $query->where('name', '=', '%' . $data['name'] . '%');
        }
        $per_page = isset($data['per_page']) ?? 10;
        return $query->paginate($per_page);
    }

    public function store(array $data): object
    {
        return $this->entity->create($data);
    }

    public function update(Profile $entity, array $data): void
    {
        $entity->fill($data);
        $entity->save();
    }

    public function destroy(Profile $entity): void
    {
        $entity->delete();
    }

    public function findById(int $id): Profile
    {
        return $this->entity->findOrFail($id);
    }

    public function getProfileAbilities(Profile $profile): array
    {
        return $profile->abilities()->get()->toArray();
    }

    public function getSlugsProfileAbilities(array $profile_abilities): array
    {
        return array_map(function ($value) {
            return $value['slug'];
        }, $profile_abilities);
    }
}
