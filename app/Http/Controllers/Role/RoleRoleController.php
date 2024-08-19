<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Role\Role;
use Illuminate\Http\Request;

class RoleRoleController extends Controller
{
    //
    public function index()
    {
        $roles = Role::all();
        return response(['role' => collect($roles)]);
    }
}
