<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanggarSeni extends Model
{
    protected $table = 'SANGGAR_SENI';
    public $timestamps = false;

    // one to many (inverse)
    public function village()
    {
      return $this->belongsTo('App\Models\Village');
    }

    public function sanggarSeniFoto()
    {
      return $this->hasMany('App\Models\SanggarSeniFoto');
    }

    public function sanggarSeniJenis()
    {
      return $this->belongsToMany('App\Models\SanggarSeniJenis', 'sanggar_seni__sanggar_seni_jenis');
    }

}
