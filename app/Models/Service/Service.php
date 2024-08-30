<?php

namespace App\Models\Service;

use App\Models\Fnc\FncEncaissementInscription;
use App\Models\Fnc\FncEncaissementLine;
use App\Models\Fnc\FncEncaissements;
use App\Models\Section\Section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['Label', 'Alias', 'Price', 'Icon', 'Frequenc', 'Obligation', 'Enabled', 'Section'];


    // relations 
    public function section()
    {
        return $this->belongsTo(Section::class, 'Section');
    }
    // functions 
    public function getIcon()
    {
        $path = url('backend/storage/app/public/services/' . $this->Icon);
        // $path =   '/storage/services/'  . $this->Icon;
        if ($this->Icon) {
            return $path;
        }
        return '/storage/services/saving.png';
    }
    public function isTrimestriel()
    {

        return $this->Frequenc == 'Trimestriel';
    }
    public function isMensuel()
    {

        return $this->Frequenc == 'Mensuel';
    }
    public function isAnnuell()
    {

        return $this->Frequenc == 'Annuel';
    }
    public function isOneTime()
    {

        return $this->Frequenc == 'Onetime';
    }
    public static function months()
    {

        return [
            '01' => 'M1',
            '02' => 'M2',
            '03' => 'M3',
            '04' => 'M4',
            '05' => 'M5',
            '06' => 'M6',
            '07' => 'M7',
            '08' => 'M8',
            '09' => 'M9',
            '10' => 'M10',
            '11' => 'M11',
            '12' => 'M12',
        ];
    }
    public static  function getMonthsWithName()
    {

        $list = [
            '01' => 'Janvier',
            '02' => 'Février',
            '03' => 'Mars',
            '04' => 'April',
            '05' => 'Mai',
            '06' => 'Juin',
            '07' => 'Juillet',
            '08' => 'Aout',
            '09' => 'Séptembre',
            '10' => 'Octobre',
            '11' => 'Novembre',
            '12' => 'décembre',

        ];
        return $list;
    }
    public static function trimsetrial()
    {

        return [
            1 => 'T1',
            2 => 'T2',
            3 => 'T3',
        ];
    }
    public function getCA()
    {
        $amount = FncEncaissementInscription::where('Service', $this->id)->sum('Amount');
        $total = $amount ?: 0;
        return $total;
    }
    public function getME()
    {
        $payed = FncEncaissementLine::where('Service', $this->id)->whereNull('Canceled')->sum('Amount');
        $total = $payed ?: 0;
        return $total;
    }

    public static function getTotalCA()
    {
        $amount = FncEncaissementInscription::sum('Amount');
        $total = $amount ?: 0;
        return $total;
    }
    public static function getTotalME()
    {
        $payed = FncEncaissementLine::whereNull('Canceled')->sum('Amount');
        $total = $payed ?: 0;
        return $total;
    }
}
