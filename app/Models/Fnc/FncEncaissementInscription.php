<?php

namespace App\Models\Fnc;

use App\Models\Inscription\Inscription;
use App\Models\Promotion\Promotion;
use App\Models\Service\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FncEncaissementInscription extends Model
{
    use HasFactory;
    protected $fillable = ['Amount', 'Frequenc', 'Service', 'Inscription', 'Promotion', 'User'];


    // relations 
    public function user()
    {
        return $this->belongsTo(User::class, 'User');
    }
    public function inscription()
    {
        return $this->belongsTo(Inscription::class, 'Inscription');
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
}
