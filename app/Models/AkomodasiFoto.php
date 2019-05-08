<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AkomodasiFoto extends Model
{
    protected $table = 'akomodasi_foto';
    public $timestamps = false;

    public function akomodasi()
    {
      return $this->belongsTo('App\Models\Akomodasi');
    }

}
