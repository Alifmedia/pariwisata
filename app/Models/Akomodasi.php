<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Akomodasi extends Model
{
    protected $table = 'akomodasi';
    public $timestamps = false;

    public function hotel()
    {
      return $this->hasMany('App\Models\Hotel');
    }

    //one to many
    public function dataHunian()
    {
      return $this->hasMany('App\Models\DataHunian');
    }

    public function akomodasiFoto()
    {
      return $this->hasMany('App\Models\AkomodasiFoto');
    }

    // one to many (inverse)
    public function tipeAkomodasi()
    {
      return $this->belongsTo('App\Models\TipeAkomodasi');
    }

    public function levelAkomodasi()
    {
      return $this->belongsTo('App\Models\LevelAkomodasi');
    }

    public function village()
    {
      return $this->belongsTo('App\Models\Village');
    }

    //many to many
    public function jenisKamar()
    {
      return $this->belongsToMany('App\Models\JenisKamar', 'akomodasi__jenis_kamar');
    }

}
