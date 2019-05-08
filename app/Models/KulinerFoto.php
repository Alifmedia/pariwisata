<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KulinerFoto extends Model
{
    protected $table = 'kuliner_foto';
    public $timestamps = false;

    public function kuliner()
    {
      return $this->belongsTo('App\Models\Kuliner', 'kuliner_id');
    }

}
