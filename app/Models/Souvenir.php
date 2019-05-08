<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Souvenir extends Model
{
    protected $table = 'SOUVENIR';
    public $timestamps = false;

    //one to many
    public function foto()
    {
      return $this->hasMany('App\Models\Foto');
    }

    // one to many (inverse)
    public function village()
    {
      return $this->belongsTo('App\Models\Village');
    }

}
