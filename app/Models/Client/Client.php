<?php

namespace App\Models\Client;

use App\Models\HandicapCause\handicapCause;
use App\Models\Inscription\Inscription;
use App\Models\Module\Module;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'Cin',
        'Region',
        'Province',
        'Ville',
        'Arrondissement',
        'Facebook',
        'Instagram',
        'Tiktok',
        'Handicap',
        'TypeHandicap',
        'causeH',
        'DateHandicap',
        'Birthday',
        'Whatsapp',
        'CauseHandicap',
        'Autonomie',
        'User'
    ];


    // relations 
    public function user()
    {
        return $this->belongsTo(User::class, 'User');
    }
    public function cause()
    {
        return $this->belongsTo(handicapCause::class, 'causeH');
    }
    public function inscriptions()
    {
        return $this->hasMany(Inscription::class, 'Client');
    }
    public function getModules()
    {
        $list = [];
        $inscription = $this->inscription();
        $modules =  DB::select('select * from modules where id in (select distinct(Module) from fnc_encaissement_inscriptions where Inscription = ' . $inscription->id . ')');

        foreach ($modules as $key => $value) {
            $list[] = [
                'id' => $value->id,
                'alias' => $value->Alias,
                'label' => $value->Label,
            ];
        }
        return $list;
    }
    public function inscription()
    {

        $inscription = Inscription::where('Client', $this->id)->orderBy('id', 'DESC')->first();
        return $inscription;
    }
    // functions 

}
