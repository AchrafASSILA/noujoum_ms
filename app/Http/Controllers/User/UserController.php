<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RoleRoleController extends Controller
{
    //
    public function index()
    {
        try {
            //code...
            $list = User::where('role', '<>', 1)->where('role', '<>', 2)->orderBy('created_at', 'DESC')->get();
            $data = [];
            foreach ($list as $user) {
                # code...
                $data['users'][] = [
                    'id' => $user->id,
                    'name' => $user->getFullName(),
                    'email' => $user->email,
                    'tel' => $user->tel,
                    'adress' => $user->adress,
                    'age' => $user->age,
                    'active' => $user->Active ? true : false,
                    'image' => $user->getImage(),
                ];
            }

            return response($data, 200);
        } catch (\Exception $e) {
            //throw $th;
            return response(['msg' => $e->getMessage()], 400);
        }
    }
}
