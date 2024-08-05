<?php

namespace App\Models\Inscription;

use App\Models\Client\Client;
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
}
