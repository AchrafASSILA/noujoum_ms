<?php

namespace App\Http\Controllers\Fnc;

use App\Exports\EtatExport;
use App\Exports\EtatJournalierExport;
use App\Http\Controllers\Controller;
use App\Models\Config\Config;
use App\Models\Fnc\FncEncaissementInscription;
use App\Models\Fnc\FncEncaissementLine;
use App\Models\Service\Service;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

use PDF;

class FncController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function etat_financier_global_per_services()
    {
        try {

            $data = [];
            $data['services'] = [];

            $services = Service::orderBy('created_at')->get();
            foreach ($services as $service) {
                $ca = $service->getCA(); //chiffre d'affaire
                $me = $service->getME(); //montant encaissé
                $reste = $ca - $me;
                $data['services'][] = [
                    'label' => $service->Label,
                    'chiffre_affaire' => number_format($ca, 2) . ' DH',
                    'montant_encaisse' => number_format($me, 2) . ' DH',
                    'reste' => number_format($reste, 2) . ' DH',
                    'color' => '#683d85'
                ];
            }
            $ca_total = Service::getTotalCA(); //chiffre d'affaire total
            $me_total =  Service::getTotalME(); //montant encaissé total
            $reste_total = $ca_total - $me_total;
            $data['total'] = [
                'total_ca' => number_format($ca_total, 2) . ' DH',
                'total_me' => number_format($me_total, 2) . ' DH',
                'total_resteb' => number_format($reste_total, 2) . ' DH',
                'color' => '#683d85'
            ];
            return response($data, 200);
        } catch (\Exception $e) {
            //throw $th;
            return response(['msg' => $e->getMessage()], 400);
        }
    }
    public function etat_journalier(Request $request)
    {
        try {

            $data = [
                'inscriptions' => [],
            ];
            $inscriptions = [];
            $where = [];
            $date = $request->has('date') && $request->date ? $request->date : date('Y-m-d');



            $fnc_inscriptions = FncEncaissementLine::where('created_at', 'like', $date . '%')->orderBy('created_at')->get();
            $total = 0;
            foreach ($fnc_inscriptions as $fnc_inscription) {
                if (in_array($fnc_inscription->inscription->id, $inscriptions)) continue;
                $totalPayed = FncEncaissementLine::where('Inscription', $fnc_inscription->inscription->id)->where('created_at', 'like', $date . '%')->whereNull('Canceled')->sum('Amount');

                $total += $totalPayed;
                $data['inscriptions'][$fnc_inscription->inscription->id] = [
                    'name' => $fnc_inscription->inscription->client->user->getFullName(),
                    'image' => $fnc_inscription->inscription->client->user->getImage(),
                    'totalPayed' => number_format($totalPayed, 2) . ' DH',
                    'date' => $date,

                ];
                $inscriptions[] = $fnc_inscription->inscription->id;
            }
            $data['inscriptions'] = array_values($data['inscriptions']);
            $data['total'] = number_format($total, 2) . ' DH';
            $data['date'] = $date;

            return response($data, 200);
        } catch (\Exception $e) {
            //throw $th;
            return response(['msg' => $e->getMessage()], 400);
        }
    }
    public function exportEtatServicesPdf()
    {

        $data = [];
        $data['services'] = [];

        $services = Service::orderBy('created_at')->get();

        $ca_total = Service::getTotalCA(); //chiffre d'affaire total
        $me_total =  Service::getTotalME(); //montant encaissé total
        $reste_total = $ca_total - $me_total;
        $html = view()->make('impressions/etat_global_par_services', [
            'services' => $services,
            'ca_total' => ($ca_total),
            'me_total' => ($me_total),
            'reste_total' => ($reste_total),
            'config' => Config::first(),
        ])->render();
        PDF::SetTitle('Etat global par services');
        PDF::AddPage();
        PDF::writeHTML($html);;
        PDF::Output('etat_global_par_services.pdf');
    }
    public function exportEtats()
    {

        return Excel::download(new EtatExport, 'etat_par_services.xlsx');
    }
    public function exportEtatJournalierPdf(Request $request)
    {




        $date = $request->has('date') && $request->date ? $request->date : date('Y-m-d');



        $fnc_inscriptions = FncEncaissementLine::where('created_at', 'like', $date . '%')->orderBy('created_at')->get();






        $html = view()->make('impressions/etat_journalier', [
            'fnc_inscriptions' => $fnc_inscriptions,
            'date' => $date,
            'config' => Config::first(),
        ])->render();
        PDF::SetTitle('Etat journalier');
        PDF::AddPage();
        PDF::writeHTML($html);;
        PDF::Output('etat_journalier.pdf');
    }
    public function exportEtatJournalier(Request $request)
    {
        $date = $request->has('date') && $request->date ? $request->date : date('Y-m-d');

        return Excel::download(new EtatJournalierExport($date), 'etat_journalier.xlsx');
    }
}
