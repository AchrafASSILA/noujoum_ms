<?php


namespace App\Exports;

use App\Models\Config\Config;
use App\Models\Fnc\FncEncaissementLine;
use App\Models\Service\Service;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class EtatJournalierExport implements FromView
{
    public static  $date = '';
    public function __construct($date)
    {
        static::$date = $date;
    }
    public function view(): View
    {
        $fnc_inscriptions = FncEncaissementLine::where('created_at', 'like', static::$date . '%')->orderBy('created_at')->get();


        return view('exports.etats_journalier', [
            'fnc_inscriptions' => $fnc_inscriptions,
            'date' => static::$date,
        ]);
    }
}
