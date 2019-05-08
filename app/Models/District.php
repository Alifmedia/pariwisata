<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'DISTRICT';
    public $timestamps = false;

    //one to many
    public function village()
    {
      return $this->hasMany('App\Models\Village');
    }

    // one to many (inverse)
    public function regional()
    {
      return $this->belongsTo('App\Models\Regional');
    }

}
