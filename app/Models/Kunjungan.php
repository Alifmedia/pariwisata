<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    protected $table = 'kunjungan';
    public $timestamps = false;

    // one to many (inverse)
    public function objekWisata()
    {
      return $this->belongsTo('App\Models\ObjekWisata');
    }
    public function user()
    {
      return $this->belongsTo('App\Models\User');
    }

}
