<?php

namespace App\Models\Module;

use App\Models\Section\Section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $fillable = ['Label', 'Alias', 'Color', 'Section'];


    // relations
    public function section()
    {
        return $this->belongsTo(Section::class, 'Section');
    }
}
