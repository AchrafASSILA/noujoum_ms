<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\Service\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // orderBy('Section', 'DESC')->
            $list = Service::orderBy('created_at', 'DESC')->get();
            $data = [];
            $data['services'] = [];
            foreach ($list as $service) {
                # code...
                $data['services'][] = [
                    'id' => $service->id,
                    'label' => $service->Label,
                    'alias' => $service->Alias,
                    'price' => $service->Price,
                    'priceLabel' => $service->Price . ' DH',
                    'frequenc' => $service->Frequenc,
                    'section' => [
                        'id' => $service->section->id,
                        'label' => $service->section->Label,
                    ],
                    'obligation' => $service->Obligation ? true : false,
                    'enabled' => $service->Enabled ? true : false,
                    'obligationLabel' => $service->Obligation ? 'requis' : 'pas requis',
                    'enabledLabel' => $service->Enabled ? 'active' : 'pas active',
                    'enabledClass' => $service->Enabled ? 'text-outline-success' : 'text-outline-danger',
                    'obligationClass' => $service->Obligation ? 'text-outline-success' : 'text-outline-danger',
                    'image' => $service->getIcon(),
                ];
            }

            return response($data, 200);
        } catch (\Exception $e) {
            //throw $th;
            return response(['msg' => $e->getMessage()], 400);
        }
    }
    public function reductions()
    {
        try {
            $data = [];
            $data['reductions'] = [
                [
                    'id' => 7,
                    'label' => '5%',
                    'value' => '5',
                ],
                [
                    'id' => 1,
                    'label' => '10%',
                    'value' => '10',
                ],
                [
                    'id' => 2,
                    'label' => '25%',
                    'value' => '25',
                ],
                [
                    'id' => 3,
                    'label' => '30%',
                    'value' => '30',
                ],
                [
                    'id' => 4,
                    'label' => '50%',
                    'value' => '50',
                ],
                [
                    'id' => 5,
                    'label' => '75%',
                    'value' => '75',
                ],
                [
                    'id' => 6,
                    'label' => '100%',
                    'value' => '100',
                ],
            ];


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
                'label' => 'required|max:100|string|unique:services',
                'price' => 'required',
                'frequenc' => 'required',
                'section' => 'required',
            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }

            $service = Service::create([
                'Label' => $request->label,
                'Alias' => Str::slug($request->label),
                'Price' => $request->price,
                'Obligation' => $request->obligation == 'true' ? 1 : 0,
                'Enabled' => $request->enabled == 'true' ? 1 : 0,
                'Frequenc' => $request->frequenc,
                'Section' => $request->section,
            ]);
            if ($request->hasFile('file')) {
                // move image
                $imageName = time() . '.' . $request->file->getClientOriginalExtension();
                $request->file->storeAs('/public/services', $imageName);
                // set image
                $service->Icon = $imageName;
                // save image
                $service->save();
            }
            return response(['msg' => 'Service save with succes', 'service' => $service], 200);
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
            $service = Service::find($id);

            $validation = Validator::make($request->all(), [
                'label' => 'required|max:100|string|unique:services,Label,' . $service->id,
                'price' => 'required',
                'frequenc' => 'required',
                'section' => 'required',

            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }

            $service->update([
                'Label' => $request->label,
                'Alias' => Str::slug($request->label),
                'Price' => $request->price,
                'Obligation' => $request->obligation == 'true' ? 1 : 0,
                'Enabled' => $request->enabled == 'true' ? 1 : 0,
                'Frequenc' => $request->frequenc,
                'Section' => $request->section,
            ]);
            if ($request->hasFile('file')) {
                // move image
                $imageName = time() . '.' . $request->file->getClientOriginalExtension();
                $request->file->storeAs('/public/services', $imageName);
                // set image
                $service->Icon = $imageName;
                // save image
                $service->save();
            }
            return response(['msg' => 'service update with succes.', 'service' =>  $service], 200);
        } catch (\Exception $e) {
            return response(['msg' => [$e->getMessage()]], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
    }
}
