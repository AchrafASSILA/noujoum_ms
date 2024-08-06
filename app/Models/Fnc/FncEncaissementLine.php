<?php

namespace App\Models\Fnc;

use App\Models\Inscription\Inscription;
use App\Models\Promotion\Promotion;
use App\Models\Service\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FncEncaissementLine extends Model
{
    use HasFactory;
    protected $fillable = ['Frequenc', 'Inscription', 'Affectation', 'Encaissement', 'Service', 'Promotion', 'User', 'Amount', 'Canceled'];

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
    public function encaissement()
    {
        return $this->belongsTo(FncEncaissements::class, 'Encaissement');
    }
    public function affectation()
    {
        return $this->belongsTo(FncEncaissementInscription::class, 'Affectation');
    }


    // functions 

}
