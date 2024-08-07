<?php

namespace App\Models\Edt;

use App\Models\Module\Module;
use App\Models\Sale\Sale;
use App\Models\Section\Section;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    use HasFactory;
    protected $fillable = ['Label', 'Date', 'Day', 'Start', 'End', 'Sale', 'Section', 'Module', 'UserBy'];
    // relations
    public function sale()
    {
        return $this->belongsTo(Sale::class, 'Sale');
    }
    public function section()
    {
        return $this->belongsTo(Section::class, 'Section');
    }
    public function userBy()
    {
        return $this->belongsTo(User::class, 'UserBy');
    }
    public function module()
    {
        return $this->belongsTo(Module::class, 'Module');
    }


    // functions
    public static function days()
    {
        $days = [1 => 'lundi', 2 => 'Mardi', 3 => 'Mercredi', 4 => 'Jeudi', 5 => 'Vendredi', 6 => 'Samedi', 7 => 'Dimanche'];
        return $days;
    }
}
