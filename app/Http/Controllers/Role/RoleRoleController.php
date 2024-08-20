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
        $roles = Role::whereNotIn('id' ,[ 1,2,3])->get();
        return response(['roles' => collect($roles)]);
    }
}
