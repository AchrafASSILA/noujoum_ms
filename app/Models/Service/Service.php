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
        $path =   'http://127.0.0.1:8000/storage/services/'  . $this->Icon;
        if ($this->Icon) {
            return $path;
        }
        return 'http://127.0.0.1:8000/storage/services/saving.png';
    }
}
