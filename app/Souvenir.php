<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Souvenir extends Model
{
    protected $table = 'SOUVENIR';
    protected $primaryKey = 'souv_id';
    public $timestamps = false;

    //one to many
    public function Foto()
    {
      return $this->hasMany('App\Foto', 'souv_id', 'foto_id');
    }

    // one to many (inverse)
    public function Village()
    {
      return $this->belongsTo('App\Village', 'souv_id', 'vill_id');
    }
    
}
