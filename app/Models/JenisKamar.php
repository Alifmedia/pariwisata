<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisKamar extends Model
{
    protected $table = 'JENIS_KAMAR';
    public $timestamps = false;

    //many to many
    public function akomodasi()
    {
      return $this->belongsToMany('App\Models\Akomodasi', 'akomodasi__jenis_kamar');
    }
}
