<?php

namespace App\Models\Service;

use App\Models\Section\Section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['Label', 'Alias', 'Price', 'Icon', 'Frequenc', 'Obligation', 'Enabled', 'Section'];


    // relations 
    public function section()
    {
        return $this->belongsTo(Section::class, 'Section');
    }
    // functions 
    public function getIcon()
    {
        $path =   '/storage/services/'  . $this->Icon;
        if ($this->Icon) {
            return $path;
        }
        return '/storage/services/saving.png';
    }
    public function isTrimestriel()
    {

        return $this->Frequenc == 'Trimestriel';
    }
    public function isMensuel()
    {

        return $this->Frequenc == 'Mensuel';
    }
    public function isAnnuell()
    {

        return $this->Frequenc == 'Annuel';
    }
    public function isOneTime()
    {

        return $this->Frequenc == 'Onetime';
    }
    public static function months()
    {

        return [
            1 => 'M1',
            2 => 'M2',
            3 => 'M3',
            4 => 'M4',
            5 => 'M5',
            6 => 'M6',
            7 => 'M7',
            9 => 'M9',
            10 => 'M10',
            11 => 'M11',
            12 => 'M12',
        ];
    }
    public static function trimsetrial()
    {

        return [
            1 => 'T1',
            2 => 'T2',
            3 => 'T3',
            4 => 'T4',
        ];
    }
}
