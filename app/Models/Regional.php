<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regional extends Model
{
    protected $table = 'REGIONAL';
    public $timestamps = false;

    //one to many
    public function district()
    {
      return $this->hasMany('App\Models\District');
    }

    // one to many (inverse)
    public function prov()
    {
      return $this->belongsTo('App\Models\Prov');
    }
}
