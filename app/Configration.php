<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configration extends Model
{
    protected $fillable = ['config_name', 'config_value'];
    public static function getConfigValue($name){
        return self::where('config_name', $name)->first()->config_value;
    }
}
