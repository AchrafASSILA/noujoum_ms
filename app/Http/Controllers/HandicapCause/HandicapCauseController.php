<?php

namespace App\Http\Controllers\HandicapCause;

use App\Http\Controllers\Controller;
use App\Models\HandicapCause\handicapCause;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;




class HandicapCauseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $list = handicapCause::all();
            $data = [];
            $data['handicapCauses'] = [];
            foreach ($list as $handicapCause) {
                # code...
                $data['handicapCauses'][] = [
                    'id' => $handicapCause->id,
                    'label' => $handicapCause->Label,
                    'alias' => $handicapCause->Alias,
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
                'label' => 'required|max:100|string|unique:handicap_causes',
            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }

            $handicapCause = handicapCause::create([
                'Label' => $request->label,
                'Alias' => Str::slug($request->label),
            ]);

            return response(['msg' => 'Section save with succes', 'handicapCause' => $handicapCause], 200);
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
            $handicapCause = handicapCause::find($id);
            $validation = Validator::make($request->all(), [
                'label' => 'required|max:100|string|unique:handicap_causes,Label,' . $handicapCause->id,

            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }
            //code...
            $handicapCause->update([
                'Label' => $request->label,
                'Alias' => Str::slug($request->label),
            ]);
            return response(['msg' => 'section update with succes.', 'handicapCause' =>  $handicapCause], 200);
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
            $handicapCause = handicapCause::find($id);
            $handicapCause->delete();
            return response($data, 200);
        } catch (\Exception $e) {
            return response(['msg' => $e->getMessage()], 200);
        }
    }
}
