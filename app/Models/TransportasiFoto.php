<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransportasiFoto extends Model
{
    protected $table = 'transportasi_foto';
    public $timestamps = false;

    public function transportasi()
    {
      return $this->belongsTo('App\Models\SanggarSeni');
    }

}
