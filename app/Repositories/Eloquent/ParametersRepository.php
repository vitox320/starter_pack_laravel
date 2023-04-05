<?php

namespace App\Repositories\Eloquent;

use App\Models\Parameters;
use App\Repositories\Interfaces\ParametersRepositoryInterface;

class ParametersRepository implements ParametersRepositoryInterface
{
    public function __construct(public Parameters $entity){}

    public function getParametersValueByParameterName(string $parameterName)
    {
        $parameter = $this->entity::query()->where('name', '=', $parameterName)->first();
        return $parameter->value;
    }

    public function store(array $data)
    {
        return $this->entity->create($data);
    }
}
