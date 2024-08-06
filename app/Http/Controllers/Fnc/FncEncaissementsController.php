<?php

namespace App\Http\Controllers\Fnc;

use App\Http\Controllers\Controller;
use App\Models\Fnc\FncEncaissementLine;
use App\Models\Fnc\FncEncaissements;
use App\Models\Inscription\Inscription;
use App\Models\Service\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FncEncaissementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $data = [];
            $data['encaissemnets'] = [];

            $encaissemnets = FncEncaissements::orderBy('created_at')->get();
            foreach ($encaissemnets as $encaissemnet) {
                $data['encaissemnets'][] = [
                    'id' => $encaissemnet->id,
                    'amount' => $encaissemnet->Amount,
                    'name' => $encaissemnet->inscription->client->user->getFullName(),
                    'image' => $encaissemnet->inscription->client->user->getImage(),
                    'recunumber' => $encaissemnet->RecuNumber,
                    'mode' => $encaissemnet->Mode,
                    'canceled' => $encaissemnet->Canceled,
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
                'services' => 'required',
                'inscription' => 'required',
                'total' => 'required',
            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }
            $inscription = Inscription::find($request->inscription);

            $encaissement = new FncEncaissements();
            $encaissement->Total = $request->total;
            $encaissement->Inscription = $inscription->id;
            $encaissement->Promotion = $inscription->promotion->id;
            $encaissement->RecuNumber = FncEncaissementLine::getRecuNumber();
            $encaissement->OperationNumber = FncEncaissementLine::getOperationNumber();
            $encaissement->save();
            foreach ($request->services as $key => $item) {
                [$id, $amount, $frequenc] = explode('_', $item);

                $service = Service::find($id);
                $encaissment_line = new FncEncaissementLine();
                $encaissment_line->Amount = $amount;
                $encaissment_line->Frequenc = $frequenc;
                $encaissment_line->Service = $service->id;
                $encaissment_line->Affectation = $request->affectation;
                $encaissment_line->Encaissement = $encaissement->id;
                $encaissment_line->Inscription = $inscription->id;
                $encaissment_line->Promotion = $inscription->promotion->id;
                $encaissment_line->User = Auth::user()->id;
                $encaissment_line->save();
            }




            return response(['msg' => 'Payement save with succes',], 200);
        } catch (\Exception $e) {
            //throw $e;
            return response(['msg' => $e->getMessage()], 403);
        }
    }
    public function canceldPaiement(int $id)
    {
        //
        try {
            $encaissement = FncEncaissements::find($id);
            $encaissement_lines = FncEncaissementLine::where('Encaissement', $encaissement->id)->get();
            foreach ($encaissement_lines as $encaissement_line) {
                $encaissement_line->Canceled = date('Y-m-d H:i:s');
                $encaissement_line->save();
            }
            $encaissement->Canceled = date('Y-m-d H:i:s');
            $encaissement->save();
            return response(['msg' => 'canceled paiement'], 200);
        } catch (\Exception $e) {
            return response(['msg' => $e->getMessage()], 403);
        }
    }
    public function recu(int $id)
    {

        try {
            $encaissement = FncEncaissements::find($id);
            $encaissement_lines = FncEncaissementLine::where('Encaissement', $encaissement->id)->get();

            return response(['msg' => 'canceled paiement'], 200);
        } catch (\Exception $e) {
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
        //
    }
}
