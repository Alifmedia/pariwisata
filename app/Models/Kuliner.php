<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kuliner extends Model
{
    protected $table = 'kuliner';
    public $timestamps = false;

    //one to many
    public function kulinerFoto()
    {
      return $this->hasMany('App\Models\KulinerFoto', 'kuliner_id');
    }

    // one to many (inverse)
    public function kulinerKategori()
    {
      return $this->belongsTo('App\Models\KulinerKategori');
    }

    public function village()
    {
      return $this->belongsTo('App\Models\Village');
    }
}
