<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ParametersService;
use Illuminate\Http\Request;

class ParametersController extends Controller
{
    public function __construct(public ParametersService $service)
    {
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'value' => 'required'
        ]);
        $this->service->store($request);

    }
}
