<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObjekWisataKat extends Model
{
    protected $table = 'OBJWIS_KATEGORI';
    protected $primaryKey = 'kat_id';
    public $timestamps = false;

    //one to many
    public function ObjekWisata()
    {
      return $this->hasMany('App\Models\ObjekWisata', 'kat_id', 'objwis_id');
    }
}