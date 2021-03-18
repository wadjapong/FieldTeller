<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Resources\Abilities as AbilitiesResource;

class AbilitiesController extends Controller
{
    public function index()
    {
        $permissions = auth()->user()->roles()->with('permissions')->get()
        ->pluck('permissions')
        ->flatten()
        ->pluck('action')
        ->toArray();

        return new AbilitiesResource($permissions);
    }
}
