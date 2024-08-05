<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\Client;
use App\Models\Inscription\Inscription;
use App\Models\Promotion\Promotion;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $list = Client::orderBy('created_at', 'DESC')->get();
            $data = [];
            $data['clients'] = [];
            foreach ($list as $client) {
                $data['clients'][] = [
                    'id' => $client->id,
                    'name' => $client->user->name,
                    'email' => $client->user->email,
                    'tel' => $client->user->tel,
                    'image' => $client->user->getImage(),
                    'role' => $client->user->roles->Label,
                    'handicap' => $client->Handicap,
                    'handicapLabel' => $client->Handicap ? 'oui' : 'non',
                ];
            }

            return response($data, 200);
        } catch (\Exception $e) {
            //throw $th;
            return response(['msg' => $e->getMessage()], 400);
        }
    }

    public function archivedClients()
    {
        try {

            $list = Client::onlyTrashed()->orderBy('created_at', 'DESC')->get();
            $data = [];
            $data['clients'] = [];
            foreach ($list as $client) {
                $data['clients'][] = [
                    'id' => $client->id,
                    'name' => $client->user->name,
                    'email' => $client->user->email,
                    'tel' => $client->user->tel,
                    'image' => $client->user->getImage(),
                    'role' => $client->user->roles->Label,
                    'handicap' => $client->Handicap,
                    'handicapLabel' => $client->Handicap ? 'oui' : 'non',
                ];
            }

            return response($data, 200);
        } catch (\Exception $e) {
            //throw $th;
            return response(['msg' => $e->getMessage()], 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //code...
            $validation = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'email' => 'required|max:100|email|unique:users',
                'tel' => 'required|max:100|unique:users',
            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }
            // save user 
            $user = new User();
            $user->name = $request->name;
            $user->adress = $request->adress;
            $user->role = 3;
            $user->age = $request->age;
            $user->tel = $request->tel;
            $user->active = $request->active;
            $user->email = $request->email;
            $user->save();
            // save client and link with user
            $client = Client::create([
                'Cin' => $request->cin,
                'Region' => $request->region,
                'Province' => $request->province,
                'Ville' => $request->ville,
                'Arrondissement' => $request->arrondissement,
                'Facebook' => $request->facebook,
                'Instagram' => $request->instagram,
                'Tiktok' => $request->tiktok,
                'Handicap' => $request->handicap == 'true' ? 1 : 0,
                'TypeHandicap' => $request->typeHandicap,
                'DateHandicap' => $request->dateHandicap,
                'CauseHandicap' => $request->causeHandicap,
                'Autonomie' => $request->autonomie,
                'User' => $user->id,
            ]);
            // save inscription and link with client
            $inscription = new Inscription();
            $inscription->Client = $client->id;
            $inscription->Promotion = Promotion::current()->id;
            $inscription->Validation = date('Y-m-d H:i:s');
            $inscription->save();
            if ($request->hasFile('file')) {
                // move image
                $imageName = time() . '.' . $request->file->getClientOriginalExtension();
                $request->file->storeAs('/public/users', $imageName);
                // set image
                $user->Image = $imageName;
                // save image
                $user->save();
            }
            return response(['msg' => 'Client save with succes', 'client' => $client], 200);
        } catch (\Exception $e) {
            //throw $e;
            return response(['msg' => [$e->getMessage()]], 403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {

            $client = Client::find($id);
            $data['client'] = [
                'id' => $client->id,
                'name' => $client->user->name,
                'adress' => $client->user->adress,
                'age' => $client->user->age,
                'tel' => $client->user->tel,
                'active' => $client->user->active,
                'email' => $client->user->email,
                'cin' => $client->Cin,
                'region' => $client->Region,
                'province' => $client->Province,
                'ville' => $client->Ville,
                'arrondissement' => $client->Arrondissement,
                'facebook' => $client->Facebook,
                'instagram' => $client->Instagram,
                'tiktok' => $client->Tiktok,
                'handicap' => $client->Handicap ? true : false,
                'typeHandicap' => $client->TypeHandicap,
                'dateHandicap' => $client->DateHandicap,
                'causeHandicap' => $client->CauseHandicap,
                'autonomie' => $client->Autonomie,
                'image' => $client->user->getImage(),
            ];


            return response($data, 200);
        } catch (\Exception $e) {
            //throw $th;
            return response(['msg' => $e->getMessage()], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        try {

            $client = Client::find($id);
            $data['client'] = [
                'name' => $client->name,
                'adress' => $client->adress,
                'age' => $client->age,
                'tel' => $client->tel,
                'active' => $client->active,
                'email' => $client->email,
                'Cin' => $client->cin,
                'Region' => $client->region,
                'Province' => $client->province,
                'Ville' => $client->ville,
                'Arrondissement' => $client->arrondissement,
                'Facebook' => $client->facebook,
                'Instagram' => $client->instagram,
                'Tiktok' => $client->tiktok,
                'Handicap' => $client->handicap  ? true : true,
                'TypeHandicap' => $client->typeHandicap,
                'DateHandicap' => $client->dateHandicap,
                'CauseHandicap' => $client->causeHandicap,
                'Autonomie' => $client->autonomie,
            ];


            return response($data, 200);
        } catch (\Exception $e) {
            //throw $th;
            return response(['msg' => $e->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        try {
            $client = Client::find($id);
            $validation = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'email' => 'required|max:100|email|unique:users,email,' . $client->user->id,
                'tel' => 'required|max:100|unique:users,tel,' . $client->user->id,
            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }

            // save client and link with user
            $client->update([
                'Cin' => $request->cin != 'undefined' ? $request->cin : null,
                'Region' => $request->region != 'undefined' ? $request->region : null,
                'Province' => $request->province != 'undefined' ? $request->province : null,
                'Ville' => $request->ville != 'undefined' ? $request->ville : null,
                'Arrondissement' => $request->arrondissement != 'undefined' ? $request->arrondissement : null,
                'Facebook' => $request->facebook != 'undefined' ? $request->facebook : null,
                'Instagram' => $request->instagram != 'undefined' ? $request->instagram : null,
                'Tiktok' => $request->tiktok != 'undefined' ? $request->tiktok : null,
                'Handicap' => $request->handicap == 'true' ? 1 : 0,
                'TypeHandicap' => $request->typeHandicap != 'undefined' ? $request->typeHandicap : null,
                'DateHandicap' =>  $request->dateHandicap != 'undefined' ? $request->dateHandicap : null,
                'CauseHandicap' => $request->causeHandicap != 'undefined' ? $request->causeHandicap : null,
                'Autonomie' => $request->autonomie != 'undefined' ? $request->autonomie : null,
            ]);
            // update user 
            $user =  User::find($client->user->id);
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
            return response(['msg' => 'Client update with succes', 'client' => $client], 200);
        } catch (\Exception $e) {
            //throw $e;
            return response(['msg' => [$e->getMessage()]], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
        try {
            //code...
            $data = array();
            $data['msg'] = 'deleted succesfully';
            $client = Client::find($id);

            $client->delete();

            return response($data, 200);
        } catch (\Exception $e) {
            return response(['msg' => $e->getMessage()], 200);
        }
    }
    public function unarchived(Request $request, int $id)
    {
        //
        try {
            //code...
            $data = array();
            $data['msg'] = 'unarcjived succesfully';
            $client = Client::onlyTrashed()->find($id);

            $client->restore();
            return response($data, 200);
        } catch (\Exception $e) {
            return response(['msg' => $e->getMessage()], 200);
        }
    }
    public function deleteTrached(int $id)
    {
        //
        try {
            //code...
            $data = array();
            $data['msg'] = 'deleted succesfully';
            $client = Client::onlyTrashed()->find($id);

            $client->forceDelete();

            return response($data, 200);
        } catch (\Exception $e) {
            return response(['msg' => $e->getMessage()], 200);
        }
    }
}
