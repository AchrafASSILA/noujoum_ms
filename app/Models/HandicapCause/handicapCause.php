<?php

namespace App\Models\HandicapCause;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class handicapCause extends Model
{
    use HasFactory;
    protected $fillable = ['Label', 'Alias'];
    
}
