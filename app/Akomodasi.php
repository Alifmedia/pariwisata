<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Akomodasi extends Model
{
    protected $table = 'AKOMODASI';
    protected $primaryKey = 'akom_id';
    public $timestamps = false;

    public function Hotel()
    {
      return $this->hasMany('App\Hotel', 'akom_id', 'dathuni_id');
    }

    //one to many
    public function DataHunian()
    {
      return $this->hasMany('App\DataHunian', 'akom_id', 'dathuni_id');
    }

    public function Foto()
    {
      return $this->hasMany('App\Foto', 'akom_id', 'foto_id');
    }

    // one to many (inverse)
    public function TipeAkomodasi()
    {
      return $this->belongsTo('App\TipeAkomodasi', 'akom_id', 'tipe_id');
    }

    public function Village()
    {
      return $this->belongsTo('App\Village', 'akom_id', 'vill_id');
    }

    //many to many
    public function JenisKamar()
    {
      return $this->belongsToMany('App\JenisKamar', 'DISTRIBUSI_KAMAR' ,'akom_id', 'jenkam_id');
    }

}
