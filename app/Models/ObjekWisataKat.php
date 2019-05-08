<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObjekWisataKat extends Model
{
    protected $table = 'objwis_kategori';
    public $timestamps = false;

    //one to many
    public function objekWisata()
    {
      return $this->hasMany('App\Models\ObjekWisata');
    }
}
