<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObjekWisata extends Model
{
    protected $table = 'objwis';
    public $timestamps = false;

    //one to many
    public function kunjungan()
    {
      return $this->hasMany('App\Models\Kunjungan');
    }

    public function objekWisataFoto()
    {
      return $this->hasMany('App\Models\ObjekWisataFoto', 'objwis_id');
    }

    // one to many (inverse)
    public function objekWisataKat()
    {
      return $this->belongsTo('App\Models\ObjekWisataKat');
    }

    public function village()
    {
      return $this->belongsTo('App\Models\Village');
    }
}
