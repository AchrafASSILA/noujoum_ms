<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $fillable = ['Title', 'Website', 'Logo', 'Tel', 'Email', 'Adress'];

    // functions 
    public static function  setInfos($request)
    {
        $config = Config::first() ?: new Config();
        $config->Title = $request->title;
        $config->Website = $request->website;
        $config->Email = $request->email;
        $config->Tel = $request->tel;
        $config->Adress = $request->adress;
        if ($request->hasFile('file')) {
            // move image
            $imageName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->storeAs('/public/config', $imageName);
            // set image
            $config->Logo = $imageName;
            // save image
        }
        $config->save();
        return $config;
    }
    public  function  getLogo()
    {
        $path =   '/storage/config/'  . $this->Logo;
        if ($this->Logo) {
            return $path;
        }
        return '/storage/config/default.png';
    }
}
