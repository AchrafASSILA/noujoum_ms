<?php


namespace App\Exports;

use App\Models\Config\Config;
use App\Models\Service\Service;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class EtatExport implements FromView
{
    public function view(): View
    {
        $services = Service::orderBy('created_at')->get();

        $ca_total = Service::getTotalCA(); //chiffre d'affaire total
        $me_total =  Service::getTotalME(); //montant encaissé total
        $reste_total = $ca_total - $me_total;
        return view('exports.etats_per_servcies', [
            'services' => $services,
            'ca_total' => ($ca_total),
            'me_total' => ($me_total),
            'reste_total' => ($reste_total),
            'config' => Config::first(),
        ]);
    }
}
