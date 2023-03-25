<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserInterfaceRepository
{
    public function index(): \Illuminate\Database\Eloquent\Collection;

    public function filter(array $data): LengthAwarePaginator;

    public function store(array $data): object;

    public function update(User $entity, array $data): void;

    public function destroy(User $entity): void;

    public function findById(int $id): User;


}
