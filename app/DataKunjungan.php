<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataKunjungan extends Model
{
    protected $table = 'DATA_KUNJUNGAN';
    protected $primaryKey = 'datkun_id';
    public $timestamps = false;

    // one to many (inverse)
    public function ObjekWisata()
    {
      return $this->belongsTo('App\ObjekWisata', 'datkun_id', 'objwis_id');
    }
    public function User()
    {
      return $this->belongsTo('App\User', 'datkun_id', 'user_id');
    }

}
