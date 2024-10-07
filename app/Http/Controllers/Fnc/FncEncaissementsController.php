<?php

namespace App\Http\Controllers\Fnc;

use PDF;
use App\Http\Controllers\Controller;
use App\Models\Config\Config;
use App\Models\Fnc\FncEncaissementInscription;
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
            $data['encaissements'] = [];

            $encaissemnets = FncEncaissements::orderBy('created_at')->get();
            foreach ($encaissemnets as $encaissemnet) {
                $data['encaissements'][] = [
                    'id' => $encaissemnet->id,
                    'amount' => $encaissemnet->Total . ' DH',
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
                'service' => 'required',
                'inscription' => 'required',
                'price' => 'required|numeric|min:0|not_in:0',
                // 'total' => 'required',
            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }
            $inscription = Inscription::find($request->inscription);
            $affectation = FncEncaissementInscription::find($request->service);
            $payedLines = FncEncaissementLine::where('Affectation', $affectation->id)->whereNull('Canceled')->sum('Amount');
            // $payedLines = FncEncaissementLine::where('Service', $request->service)->where('Inscription', $request->inscription)->whereNull('Canceled')->sum('Amount');
            // if ($affectation->Amount < $request->price) {
            //     return response(['msg' => ['le prix payant devrait être inférieur à ' . $affectation->Amount]], 403);
            // }
            if (($payedLines + $request->price)  > $affectation->Amount) {
                return response(['msg' => ['le prix payant devrait être inférieur à ' . ($affectation->Amount - $payedLines)]], 403);
            }
            // return ($payedLines + $request->price);

            $encaissement = new FncEncaissements();
            $encaissement->Total = $request->price;
            // $encaissement->Total = $affectation->Amount;
            $encaissement->Inscription = $inscription->id;
            $encaissement->Promotion = $inscription->promotion->id;
            $encaissement->RecuNumber = FncEncaissements::getRecuNumber();
            $encaissement->OperationNumber = FncEncaissements::getOperationNumber();
            $encaissement->Mode = 'espece';
            $encaissement->save();
            // foreach ($request->services as $key => $item) {
            //     [$id, $amount, $frequenc] = explode('_', $item);

            $service = Service::find($affectation->service->id);
            $encaissment_line = new FncEncaissementLine();
            $encaissment_line->Amount = $request->price;
            // $encaissment_line->Amount = $affectation->Amount;
            $encaissment_line->Frequenc = $affectation->Frequenc;
            $encaissment_line->Service = $service->id;
            $encaissment_line->Affectation = $affectation->id;
            $encaissment_line->Encaissement = $encaissement->id;
            $encaissment_line->Inscription = $inscription->id;
            $encaissment_line->Promotion = $inscription->promotion->id;
            $encaissment_line->User = Auth::user()->id;
            $encaissment_line->save();
            // }




            return response(['msg' => 'Payement save with succes', 'encaissement' => $encaissement], 200);
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
            return response(['msg' => 'canceled paiement', 'encaissement' => $encaissement], 200);
        } catch (\Exception $e) {
            return response(['msg' => $e->getMessage()], 403);
        }
    }
    public function recu(int $id)
    {

        try {
            $encaissement = FncEncaissements::find($id);
            $encaissement_lines = FncEncaissementLine::where('Encaissement', $encaissement->id)->get();
            $fileName = 'encaissement.pdf';
            $html = view()->make(
                'impressions/encaissement-recu',
                [
                    'encaissement' => $encaissement,
                    'config' => Config::first(),
                    'encaissement_lines' => $encaissement_lines,
                ]
            )->render();

            PDF::SetTitle('encaissement');
            PDF::AddPage();
            PDF::writeHTML($html);;
            PDF::Output($fileName);
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
