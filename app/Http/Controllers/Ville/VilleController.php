<?php

namespace App\Http\Controllers\Ville;

use App\Http\Controllers\Controller;
use App\Models\Ville\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VilleController extends Controller
{
    public function index()
    {
        try {
            $list = Ville::orderBy('created_at', 'DESC')->get();
            $data = [];
            $data['villes'] = [];
            foreach ($list as $ville) {
                $data['villes'][] = [
                    'id' => $ville->id,
                    'label' => $ville->Label,
                    'region' =>
                    [

                        'id' => $ville->region->id,
                        'label' => $ville->region->Label,
                    ],
                ];
            }

            return response($data, 200);
        } catch (\Exception $e) {
            //throw $th;
            return response(['msg' => [$e->getMessage()]], 400);
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
                'label' => 'required|max:100|string|unique:villes',
                'region' => 'required',
            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }

            $ville = Ville::create([
                'Label' => $request->label,
                'Region' => $request->region,
            ]);

            return response(['msg' => 'Module save with succes', 'ville' => $ville], 200);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        try {
            $ville = Ville::find($id);
            $validation = Validator::make($request->all(), [
                'label' => 'required|max:100|string|unique:villes,Label,' . $ville->id,
                'region' => 'required',

            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }
            //code...
            $ville->update([
                'Label' => $request->label,
                'Region' => $request->region,

            ]);
            return response(['msg' => 'ville update with succes.', 'ville' =>  $ville], 200);
        } catch (\Exception $e) {
            return response(['msg' => [$e->getMessage()]], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            //code...
            $data = array();
            $data['msg'] = 'deleted succesfully';
            $ville = Ville::find($id);
            $ville->delete();
            return response($data, 200);
        } catch (\Exception $e) {
            return response(['msg' => [$e->getMessage()]], 200);
        }
    }
}
