<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KulinerKategori extends Model
{
    protected $table = 'kuliner_kategori';
    public $timestamps = false;

    //one to many
    public function kuliner()
    {
      return $this->hasMany('App\Models\Kuliner');
    }
}
