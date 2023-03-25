<?php

namespace App\Repositories\Interfaces;


use App\Models\Profile;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProfileRepositoryInterface
{
    public function index(): \Illuminate\Database\Eloquent\Collection;

    public function filter(array $data): LengthAwarePaginator;

    public function store(array $data): object;

    public function update(Profile $entity, array $data): void;

    public function destroy(Profile $entity): void;

    public function findById(int $id): Profile;

    public function getProfileAbilities(Profile $profile);
}
