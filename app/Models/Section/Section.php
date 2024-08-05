<?php

namespace App\Models\Section;

use App\Models\Service\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable =  ['Alias', 'Label', 'Image', 'Active'];

    // functions 
    public function getImage()
    {
        $path =   'http://127.0.0.1:8000/storage/sections/'  . $this->Image;
        if ($this->Image) {
            return $path;
        }
        return  '/http://127.0.0.1:8000/storage/sections/saving.png';
    }


    // relations 
    public function services()
    {
        return $this->hasMany(Service::class, 'Section');
    }
}
