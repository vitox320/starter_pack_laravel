<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Services\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(public ProfileService $service)
    {
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        return $this->service->store($request);
    }

    public function getProfileAbilities(int $id)
    {
        return $this->service->getProfileAbilities($id);
    }
}
