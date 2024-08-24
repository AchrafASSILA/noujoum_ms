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
    protected $fillable = ['Label', 'Date', 'Day', 'Start', 'End', 'Sale', 'Section', 'User',  'Module', 'UserBy'];
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
    public function user()
    {
        return $this->belongsTo(User::class, 'User');
    }
    public function module()
    {
        return $this->belongsTo(Module::class, 'Module');
    }


    // functions
    public static function days()
    {
        $days = [
            [
                'id' => 0,
                'label' => 'Lundi',
            ],
            [
                'id' => 1,
                'label' => 'Mardi',
            ],
            [
                'id' => 2,
                'label' => 'Mercredi',
            ],
            [
                'id' => 3,
                'label' => 'Jeudi',
            ],
            [
                'id' => 4,
                'label' => 'Vendredi',
            ],
            [
                'id' => 5,
                'label' => 'Samedi',
            ],
            [
                'id' => 6,
                'label' => 'Dimanche',
            ],


        ];
        return $days;
    }
    public function getDay()
    {
        $days = [

            0 => [
                'id' => 0,
                'label' => 'Lundi',
            ],
            1 => [
                'id' => 1,
                'label' => 'Mardi',
            ],
            2 => [
                'id' => 2,
                'label' => 'Mercredi',
            ],
            3 => [
                'id' => 3,
                'label' => 'Jeudi',
            ],
            4 => [
                'id' => 4,
                'label' => 'Vendredi',
            ],
            5 => [
                'id' => 5,
                'label' => 'Samedi',
            ],
            6 => [
                'id' => 6,
                'label' => 'Dimanche',
            ],
        ];
        return $days[$this->Day];
    }
}
