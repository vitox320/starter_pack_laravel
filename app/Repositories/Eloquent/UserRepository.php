<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserInterfaceRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterfaceRepository
{
    public function __construct(public User $entity)
    {
    }

    /**
     * @param array $data
     * @return object
     */
    public function store(array $data): object
    {
        $data['password'] = Hash::make($data['password']);
        return $this->entity->create($data);
    }

    public function update(User $entity, array $data): void
    {
        $entity->fill($data);
        $entity->save();
    }

    public function destroy(User $entity): void
    {
        $entity->delete();
    }

    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->entity::all();
    }

    public function filter(array $data): LengthAwarePaginator
    {
        $query = $this->entity::query();
        if (isset($data['name'])) {
            $query->where('name', 'like', '%' . $data['name'] . '%');
        }

        $per_page = $data['per_page'] ?? 10;
        return $query->paginate($per_page);
    }

    public function findByEmail(string $email)
    {
        return $this->entity::where('email', $email)->firstOrFail();
    }

    public function findById(int $id): User
    {
        return $this->entity->findOrFail($id);
    }
}
