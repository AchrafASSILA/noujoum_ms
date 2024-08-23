<?php

namespace App\Models\Ville;

use App\Models\Region\Region;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;

    protected $fillable = ['Label', 'Region'];

    public function region()
    {
        return $this->belongsTo(Region::class, 'Region');
    }
}
