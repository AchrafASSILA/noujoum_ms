<?php

namespace App\Http\Controllers;

use App\Models\Module\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $list = Module::all();
            $data = [];
            foreach ($list as $module) {
                $data['modules'][] = [
                    'id' => $module->id,
                    'label' => $module->Label,
                    'alias' => $module->Alias,
                    'section' => $module->section->id,
                    'sectionLabel' => $module->section->Label,
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
                'label' => 'required|max:100|string|unique:modules',
                'section' => 'required',
            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }

            $module = Module::create([
                'Label' => $request->label,
                'Alias' => Str::slug($request->label),
                'Section' => $request->section,
            ]);

            return response(['msg' => 'Module save with succes', 'module' => $module], 200);
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
            $module = Module::find($id);
            $validation = Validator::make($request->all(), [
                'label' => 'required|max:100|string|unique:modules,Label,' . $module->id,
                'section' => 'required',

            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }
            //code...
            $module->update([
                'Label' => $request->label,
                'Alias' => Str::slug($request->label),
                'Section' => $request->section,

            ]);
            return response(['msg' => 'Module update with succes.', 'module' =>  $module], 200);
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
            $module = Module::find($id);
            $module->delete();
            return response($data, 200);
        } catch (\Exception $e) {
            return response(['msg' => $e->getMessage()], 200);
        }
    }
}
