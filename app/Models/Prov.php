<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prov extends Model
{
    protected $table = 'PROV';
    public $timestamps = false;

    //one to many
    public function regional()
    {
      return $this->hasMany('App\Models\Regional');
    }
}
