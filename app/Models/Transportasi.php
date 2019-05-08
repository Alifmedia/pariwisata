<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transportasi extends Model
{
    protected $table = 'TRANSPORTASI';
    public $timestamps = false;

    //one to many
    public function transportasiFoto()
    {
      return $this->hasMany('App\Models\TransportasiFoto');
    }

    // one to many (inverse)
    public function village()
    {
      return $this->belongsTo('App\Models\Village');
    }
}
