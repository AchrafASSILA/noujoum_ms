<?php

namespace App\Models\Inscription;

use App\Models\Client\Client;
use App\Models\Fnc\FncEncaissementInscription;
use App\Models\Fnc\FncEncaissementLine;
use App\Models\Fnc\FncEncaissements;
use App\Models\Promotion\Promotion;
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
    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'Promotion');
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
            $payed = FncEncaissementLine::where('Affectation', $affectation->id)->sum('Amount');

            // $list[$affectation->service->id][] = [
            $list[] = [
                'id' => $affectation->id,
                'service_id' => $affectation->service->id,
                'service_label' => $affectation->service->Label,
                'service_frequenc' => $affectation->service->Frequenc,
                'service_periode' => $affectation->Frequenc,
                'amount' => $affectation->Amount . ' DH',
                'payed' => $payed . ' DH',
                'payedAmount' => $payed,
                'reste' => ($affectation->Amount -  $payed) . ' DH',
                // 'lines' => $affectation->getLinesAmount(),
            ];
        }
        return $list;
    }
    public function getTotalPayed()
    {
        $amount = FncEncaissements::where('Inscription', $this->id)->whereNull('Canceled')->sum('Total');
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
                'total' => $item->Total . ' DH',
                'date' => date('Y-m-d', strtotime($item->created_at)),
            ];
        }
        return $encaissements;
    }
}
