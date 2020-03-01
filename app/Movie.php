<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public $incrementing = false;
    protected $fillable = [
        'id', 'title', 'rate', 'popularity', 'overview'
    ];

    public function genres(){
        return $this->belongsToMany(
            'App\Genre');
    }
    public function types(){
        return $this->belongsToMany('App\Type');
    }
    public function contain_type_id($types_id){
        $relations = $this->types()->pluck('type_id')->toArray();
        return in_array($types_id, $relations);
    }
}
