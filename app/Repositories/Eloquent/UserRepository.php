<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Notifications\UserCreated;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\File;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserRepository implements UserRepositoryInterface
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
        return DB::transaction(function () use ($data) {
            $user = $this->entity->create($data);
            $this->entity->notify(new UserCreated($user));
            return $user;
        });


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
