<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanggarSeniJenis extends Model
{
    protected $table = 'sanggar_seni_jenis';
    public $timestamps = false;

    public function sanggarSeni()
    {
      return $this->belongsToMany('App\Models\SanggarSeni', 'sanggar_seni__sanggar_seni_jenis');
    }

}
