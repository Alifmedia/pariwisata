<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipeAkomodasi extends Model
{
    protected $table = 'TIPE_AKOMODASI';
    public $timestamps = false;

    //one to many
    public function akomodasi()
    {
      return $this->hasMany('App\Models\Akomodasi');
    }

    public function levelAkomodasi()
    {
      return $this->belongsToMany('App\Models\LevelAkomodasi', 'tipe_akomodasi__level_akomodasi');
    }
}
