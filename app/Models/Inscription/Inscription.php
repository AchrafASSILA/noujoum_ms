<?php

namespace App\Models\Inscription;

use App\Models\Client\Client;
use App\Models\Fnc\FncEncaissementInscription;
use App\Models\Fnc\FncEncaissementLine;
use App\Models\Fnc\FncEncaissements;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inscription extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['Client', 'Promotion', 'Validation'];
    // relations 
    public function client()
    {
        return $this->belongsTo(Client::class, 'Client');
    }

    public function encaissements_affectations()
    {
        return $this->hasMany(FncEncaissementInscription::class, 'Inscription');
    }
    public function encaissements_lines()
    {
        return $this->hasMany(FncEncaissementLine::class, 'Inscription');
    }
    public function encaissements()
    {
        return $this->hasMany(FncEncaissements::class, 'Inscription');
    }

    // funcstions
    public function getServices()
    {
        $list = [];
        $affectations = $this->encaissements_affectations;
        foreach ($affectations as  $affectation) {
            $list[$affectation->service->id][] = [
                'service' => [
                    'id' => $affectation->service->id,
                    'label' => $affectation->service->Label,
                    'frequenc' => $affectation->service->Frequenc,
                ],
                'service_periode' => $affectation->Frequenc,
                'amount' => $affectation->Amount,
                'lines' => $affectation->getLinesAmount(),
            ];
        }
        return $list;
    }
    public function getTotalPayed()
    {
        $amount = FncEncaissements::where('Inscription', $this->id)->whereNull('Canceled')->sum('Amount');
        return $amount;
    }
    public function getTotalAffected()
    {
        $amount = FncEncaissementInscription::where('Inscription', $this->id)->sum('Amount');
        return $amount;
    }
    public function getEncaissements()
    {
        $encaissements = [];
        $list = $this->encaissements;
        foreach ($list as $item) {
            $encaissements[] = [
                'id' => $item->id,
                'recuNumber' => $item->RecuNumber,
                'mode' => $item->Mode,
                'operationNumber' => $item->OperationNumber,
                'canceled' => $item->Canceled,
                'total' => $item->Total,
            ];
        }
        return $encaissements;
    }
}
