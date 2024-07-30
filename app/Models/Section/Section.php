<?php

namespace App\Models\Section;

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
        return asset('/assets/img/icons/box.png');
    }
}
