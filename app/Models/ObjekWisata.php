<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObjekWisata extends Model
{
    protected $table = 'OBJEK_WIS';
    protected $primaryKey = 'objwis_id';
    public $timestamps = false;

    //one to many
    public function DataKunjungan()
    {
      return $this->hasMany('App\Models\DataKunjungan', 'objwis_id', 'datkun_id');
    }

    public function Foto()
    {
      return $this->hasMany('App\Models\Foto', 'objwis_id', 'foto_id');
    }

    // one to many (inverse)
    public function ObjekWisataKat()
    {
      return $this->belongsTo('App\Models\ObjekWisataKat', 'objwis_id', 'kat_id');
    }

    public function Village()
    {
      return $this->belongsTo('App\Models\Village', 'objwis_id', 'vill_id');
    }
}
