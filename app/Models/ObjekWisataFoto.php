<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObjekWisataFoto extends Model
{
    protected $table = 'objwis_foto';
    public $timestamps = false;

    public function objekWisata()
    {
      return $this->belongsTo('App\Models\ObjekWisata', 'objwis_id');
    }

}
