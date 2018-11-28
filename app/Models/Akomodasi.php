<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Akomodasi extends Model
{
    protected $table = 'AKOMODASI';
    protected $primaryKey = 'akom_id';
    public $timestamps = false;

    public function Hotel()
    {
      return $this->hasMany('App\Models\Hotel', 'akom_id', 'dathuni_id');
    }

    //one to many
    public function DataHunian()
    {
      return $this->hasMany('App\Models\DataHunian', 'akom_id', 'dathuni_id');
    }

    public function Foto()
    {
      return $this->hasMany('App\Models\Foto', 'akom_id', 'foto_id');
    }

    // one to many (inverse)
    public function TipeAkomodasi()
    {
      return $this->belongsTo('App\Models\TipeAkomodasi', 'akom_id', 'tipe_id');
    }

    public function Village()
    {
      return $this->belongsTo('App\Models\Village', 'akom_id', 'vill_id');
    }

    //many to many
    public function JenisKamar()
    {
      return $this->belongsToMany('App\Models\JenisKamar', 'DISTRIBUSI_KAMAR' ,'akom_id', 'jenkam_id');
    }

}
