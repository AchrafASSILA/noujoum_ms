<?php

namespace App\Models\Client;

use App\Models\Inscription\Inscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    public function inscriptions()
    {
        return $this->hasMany(Inscription::class, 'Client');
    }
    public function inscription()
    {

        $inscription = Inscription::where('Client', $this->id)->orderBy('id', 'DESC')->first();
        return $inscription;
    }
    // functions 

}
