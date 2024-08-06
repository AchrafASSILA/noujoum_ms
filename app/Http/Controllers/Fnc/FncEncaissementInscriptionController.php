<?php

namespace App\Http\Controllers\Fnc;

use App\Http\Controllers\Controller;
use App\Models\Fnc\FncEncaissementInscription;
use App\Models\Inscription\Inscription;
use App\Models\Service\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FncEncaissementInscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $inscription = null;
            $data = [];
            $data['inscription'] = [];
            if ($request->has('inscription') && $request->inscription) {
                $inscription = Inscription::find($request->inscription);
                $data['inscription'] = [
                    'client' => [
                        'name' => $inscription->client->user->getFullName(),
                        'image' => $inscription->client->user->getImage()
                    ],
                    'services' => $inscription->getServices(),
                    'payed' => $inscription->getTotalPayed(),
                    'affected' => $inscription->getTotalAffected(),
                    'encaissement' => $inscription->getEncaissements(),
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
        //
        try {
            //code...
            $validation = Validator::make($request->all(), [
                'service' => 'required',
                'price' => 'required',
                'inscription' => 'required',
            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }
            $service = Service::find($request->service);
            $inscription = Inscription::find($request->inscription);
            if ($service->isMensuel()) {
                foreach (Service::months() as $key => $item) {
                    $affectation = new FncEncaissementInscription();
                    $affectation->Amount = $request->price;
                    $affectation->Frequenc = $item;
                    $affectation->Service = $service->id;
                    $affectation->Inscription = $inscription->promotion->id;
                    $affectation->User = Auth::user()->id;
                    $affectation->save();
                }
            } elseif ($service->isTrimestriel()) {
                foreach (Service::trimsetrial() as $key => $item) {
                    $affectation = new FncEncaissementInscription();
                    $affectation->Amount = $request->price;
                    $affectation->Frequenc = $item;
                    $affectation->Service = $service->id;
                    $affectation->Inscription = $inscription->promotion->id;
                    $affectation->User = Auth::user()->id;
                    $affectation->save();
                }
            } else {
                $affectation = new FncEncaissementInscription();
                $affectation->Amount = $request->price;
                if ($service->isAnnuell()) {
                    $affectation->Frequenc = 'Yearly';
                } else {
                    $affectation->Frequenc = 'OneTime';
                }
                $affectation->Service = $service->id;
                $affectation->Inscription = $inscription->promotion->id;
                $affectation->User = Auth::user()->id;
                $affectation->save();
            }



            return response(['msg' => 'Affectation save with succes',], 200);
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
        //
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
            $affectation = FncEncaissementInscription::find($id);
            if ($affectation->lines) {
                return response(['msg' => 'services deja paye canceler le paiement first'], 404);
            }
            $affectation->delete();
            return response($data, 200);
        } catch (\Exception $e) {
            return response(['msg' => $e->getMessage()], 200);
        }
    }
}
