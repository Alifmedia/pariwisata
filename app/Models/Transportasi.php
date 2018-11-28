<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transportasi extends Model
{
    protected $table = 'TRANSPORTASI';
    protected $primaryKey = 'trans_id';
    public $timestamps = false;

    //one to many
    public function Foto()
    {
      return $this->hasMany('App\Models\Foto', 'trans_id', 'foto_id');
    }

    // one to many (inverse)
    public function Village()
    {
      return $this->belongsTo('App\Models\Village', 'trans_id', 'vill_id');
    }
}
