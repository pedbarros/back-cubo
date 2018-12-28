<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Information extends Eloquent {
    protected $collection = 'information';
    protected $fillable = ['firstName', 'lastName', 'participation'];
    public $timestamps = false;
}
