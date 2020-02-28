<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public $incrementing = false;
    protected $fillable = [
        'id', 'name'
    ];
}
