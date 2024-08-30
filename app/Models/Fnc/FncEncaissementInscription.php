<?php

namespace App\Models\Fnc;

use App\Models\Inscription\Inscription;
use App\Models\Module\Module;
use App\Models\Promotion\Promotion;
use App\Models\Service\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FncEncaissementInscription extends Model
{
    use HasFactory;
    protected $fillable = ['Amount', 'Frequenc', 'Service', 'Module', 'Inscription', 'Promotion', 'User'];


    // relations 
    public function user()
    {
        return $this->belongsTo(User::class, 'User');
    }
    public function inscription()
    {
        return $this->belongsTo(Inscription::class, 'Inscription');
    }
    public function module()
    {
        return $this->belongsTo(Module::class, 'Module');
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'Service');
    }
    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'Promotion');
    }
    public function lines()
    {
        return $this->hasMany(FncEncaissementLine::class, 'Affectation');
    }


    // functions
    public function getLinesAmount()
    {
        $amount = FncEncaissementLine::whereNull('Canceled')->sum('Amount');
        return $amount;
    }

    public  function getFrequencTitle()
    {

        $list = [
            'M1' => 'Janvier',
            'M2' => 'Février',
            'M3' => 'Mars',
            'M4' => 'April',
            'M5' => 'Mai',
            'M6' => 'Juin',
            'M7' => 'Juillet',
            'M8' => 'Aout',
            'M9' => 'Séptembre',
            'M10' => 'Octobre',
            'M11' => 'Novembre',
            'M12' => 'décembre',
            'T1' => 'Trimèstre 1',
            'T2' => 'Trimèstre 2',
            'T3' => 'Trimèstre 3',
            'Annuel' => 'Annuel',

        ];
        return $list[$this->Frequenc];
    }
}
