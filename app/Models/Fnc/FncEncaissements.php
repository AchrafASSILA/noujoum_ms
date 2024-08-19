<?php

namespace App\Models\Fnc;

use App\Models\Inscription\Inscription;
use App\Models\Promotion\Promotion;
use App\Models\Service\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FncEncaissements extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['Total', 'RecuNumber', 'Mode', 'OperationNumber', 'Inscription', 'Promotion', 'User', 'Canceled'];
    // relations 
    public function user()
    {
        return $this->belongsTo(User::class, 'User');
    }
    public function inscription()
    {
        return $this->belongsTo(Inscription::class, 'Inscription');
    }
    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'Promotion');
    }

    // functions 
    public  static function getRecuNumber()
    {
        $recu_number = 1;
        $fncEncaissement =     self::orderBy('created_at', 'DESC')->first();

        if ($fncEncaissement) {
            $recu_number +=  (int)$fncEncaissement->RecuNumber;
        }
        return $recu_number;
    }
    public  static function getOperationNumber()
    {
        $operation = 1;
        $fncEncaissement =     self::orderBy('created_at', 'DESC')->first();
        if ($fncEncaissement && $fncEncaissement->OperationNumber) {
            $operation +=  (int)$fncEncaissement->OperationNumber;
        }
        return $operation;
    }
}
