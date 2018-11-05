<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kuliner extends Model
{
    protected $table = 'KULINER';
    protected $primaryKey = 'kul_id';
    public $timestamps = false;

    //one to many
    public function Foto()
    {
      return $this->hasMany('App\Foto', 'kul_id', 'foto_id');
    }

    // one to many (inverse)
    public function TipeKuliner()
    {
      return $this->belongsTo('App\TipeKuliner', 'kul_id', 'tipkul_id');
    }

    //many to many
    public function Village()
    {
      return $this->belongsToMany('App\Village', 'KUL_VILL' ,'kul_id', 'vill_id');
    }
}
