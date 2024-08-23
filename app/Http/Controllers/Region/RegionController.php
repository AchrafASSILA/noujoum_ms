<?php

namespace App\Http\Controllers\Region;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use App\Models\Region\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            //code...
            $list = Region::all();
            $data = [];
            $data['regions'] = [];
            foreach ($list as $region) {

                $data['regions'][] = [
                    'id' => $region->id,
                    'label' => $region->Label,
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
                'label' => 'required|max:100|string|unique:regions',
            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }

            $region = Region::create([
                'Label' => $request->label,
            ]);

            return response(['msg' => 'Region save with succes', 'Region' => $region], 200);
        } catch (\Exception $e) {
            //throw $e;
            return response(['msg' => $e->getMessage()], 403);
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
            $region = Region::find($id);
            $validation = Validator::make($request->all(), [
                'label' => 'required|max:100|string|unique:regions,Label,' . $region->id,

            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }
            //code...
            $region->update([
                'Label' => $request->label,
            ]);

            return response(['msg' => 'Region update with succes.', 'Region' =>  $region], 200);
        } catch (\Exception $e) {
            return response(['msg' => $e->getMessage()], 403);
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
            $region = Region::find($id);
            $region->delete();
            return response($data, 200);
        } catch (\Exception $e) {
            return response(['msg' => $e->getMessage()], 200);
        }
    }
}
