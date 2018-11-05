<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObjekWisata extends Model
{
    protected $table = 'OBJEK_WIS';
    protected $primaryKey = 'objwis_id';
    public $timestamps = false;

    //one to many
    public function DataKunjungan()
    {
      return $this->hasMany('App\DataKunjungan', 'objwis_id', 'datkun_id');
    }

    public function Foto()
    {
      return $this->hasMany('App\Foto', 'objwis_id', 'foto_id');
    }

    // one to many (inverse)
    public function ObjekWisataKat()
    {
      return $this->belongsTo('App\ObjekWisataKat', 'objwis_id', 'kat_id');
    }

    public function Village()
    {
      return $this->belongsTo('App\Village', 'objwis_id', 'vill_id');
    }
}
