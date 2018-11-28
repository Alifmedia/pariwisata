<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kuliner extends Model
{
    protected $table = 'KULINER';
    protected $primaryKey = 'kul_id';
    public $timestamps = false;

    //one to many
    public function Foto()
    {
      return $this->hasMany('App\Models\Foto', 'kul_id', 'foto_id');
    }

    // one to many (inverse)
    public function TipeKuliner()
    {
      return $this->belongsTo('App\Models\TipeKuliner', 'kul_id', 'tipkul_id');
    }

    //many to many
    public function Village()
    {
      return $this->belongsToMany('App\Models\Village', 'KUL_VILL' ,'kul_id', 'vill_id');
    }
}
