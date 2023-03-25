<?php

namespace App\Repositories\Interfaces;

interface ParametersRepositoryInterface
{
    public function store(array $data);

    public function getParametersValueByParameterName(string $parameterName);
}
