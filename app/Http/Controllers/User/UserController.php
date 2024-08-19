<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
                    'roleId' => $user->roles->id,
                    'roleLabel' => $user->roles->Label,
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
    public function store(Request $request)
    {
        try {
            //code...
            $validation = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'email' => 'required|max:100|email|unique:users',
                'tel' => 'required|max:100|unique:users',
                'role' => 'required',
            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }
            // save user 
            $user = new User();
            $user->name = $request->name;
            $user->adress = $request->adress;
            $user->role = $request->role;
            $user->age = $request->age;
            $user->tel = $request->tel;
            $user->active = $request->active;
            $user->email = $request->email;
            $user->save();

            if ($request->hasFile('file')) {
                // move image
                $imageName = time() . '.' . $request->file->getClientOriginalExtension();
                $request->file->storeAs('/public/users', $imageName);
                // set image
                $user->Image = $imageName;
                // save image
                $user->save();
            }
            return response(['msg' => 'User save with succes', 'user' => $user], 200);
        } catch (\Exception $e) {
            //throw $e;
            return response(['msg' => [$e->getMessage()]], 403);
        }
    }
    public function update(Request $request, int $id)
    {
        try {
            $user = User::find($id);
            $validation = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'email' => 'required|max:100|email|unique:users,email,' . $user->id,
                'tel' => 'required|max:100|unique:users,tel,' . $user->id,
            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }


            // update user  
            $user->name = $request->name ?: null;
            $user->adress = $request->adress ?: null;
            $user->age = $request->age ?: null;
            $user->tel = $request->tel ?: null;
            $user->active = $request->active ?: null;
            $user->email = $request->email ?: null;
            $user->save();
            if ($request->hasFile('file')) {
                // move image
                $imageName = time() . '.' . $request->file->getClientOriginalExtension();
                $request->file->storeAs('/public/users', $imageName);
                // set image
                $user->Image = $imageName;
                // save image
                $user->save();
            }
            return response(['msg' => 'User update with succes', 'user' => $user], 200);
        } catch (\Exception $e) {
            //throw $e;
            return response(['msg' => [$e->getMessage()]], 403);
        }
    }
    public function updatePassword(Request $request, int $id)
    {
        try {
            $user = User::find($id);
            $validation = Validator::make($request->all(), [
                'password' => 'required|confirmed',
            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }


            // update user  
            $user->password = Hash::make($request->password);
            $user->save();

            return response(['msg' => 'User update with succes', 'user' => $user], 200);
        } catch (\Exception $e) {
            //throw $e;
            return response(['msg' => [$e->getMessage()]], 403);
        }
    }
    public function delete(int $id)
    {
        //
        try {
            //code...
            $data = array();
            $data['msg'] = 'deleted succesfully';
            $client = User::find($id);
            $client->delete();

            return response($data, 200);
        } catch (\Exception $e) {
            return response(['msg' => $e->getMessage()], 200);
        }
    }
}
