<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LevelAkomodasi extends Model
{
    protected $table = 'level_akomodasi';
    public $timestamps = false;

    public function akomodasi()
    {
      return $this->hasMany('App\Models\Akomodasi');
    }

    public function tipeAkomodasi()
    {
      return $this->belongsToMany('App\Models\TipeAkomodasi', 'tipe_akomodasi__level_akomodasi');
    }
}
