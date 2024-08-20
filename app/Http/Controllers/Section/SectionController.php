<?php

namespace App\Http\Controllers\Section;

use App\Http\Controllers\Controller;
use App\Models\Client\Client;
use App\Models\Section\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            //code...
            $list = Section::all();
            $data = [];
            $data['sections'] = [];
            foreach ($list as $section) {
                # code...
                $data['sections'][] = [
                    'id' => $section->id,
                    'label' => $section->Label,
                    'alias' => $section->Alias,
                    'active' => $section->Active ? true : false,
                    'activeLabel' => $section->Active ? 'oui' : 'non',
                    'image' => $section->getImage(),
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
                'label' => 'required|max:100|string|unique:sections',
            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }

            $section = Section::create([
                'Label' => $request->label,
                'Alias' => Str::slug($request->label),
                'Active' => $request->active == 'true' ? 1 : 0,
            ]);
            if ($request->hasFile('file')) {
                // move image
                $imageName = time() . '.' . $request->file->getClientOriginalExtension();
                $request->file->storeAs('/public/sections', $imageName);
                // set image
                $section->Image = $imageName;
                // save image
                $section->save();
            }
            return response(['msg' => 'Section save with succes', 'section' => $section], 200);
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
            $section = Section::find($id);
            $validation = Validator::make($request->all(), [
                'label' => 'required|max:100|string|unique:sections,Label,' . $section->id,

            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }
            //code...
            $section->update([
                'Label' => $request->label,
                'Alias' => Str::slug($request->label),
                'Active' => $request->active == 'true' ? 1 : 0,
            ]);
            if ($request->hasFile('file')) {
                // move image
                $imageName = time() . '.' . $request->file->getClientOriginalExtension();
                $request->file->storeAs('/public/sections', $imageName);
                // set image
                $section->Image = $imageName;
                // save image
                $section->save();
            }
            return response(['msg' => 'section update with succes.', 'section' =>  $section], 200);
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
            $section = Section::find($id);
            $section->delete();
            return response($data, 200);
        } catch (\Exception $e) {
            return response(['msg' => $e->getMessage()], 200);
        }
    }
}
