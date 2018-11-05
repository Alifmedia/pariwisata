<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BiroPerjalanan extends Model
{
    protected $table = 'BIRO_PERJALANAN';
    protected $primaryKey = 'biroper_id';
    public $timestamps = false;

    //one to many
    public function Foto()
    {
      return $this->hasMany('App\Foto', 'biroper_id', 'foto_id');
    }

    //many to many
    public function Village()
    {
      return $this->belongsToMany('App\Village', 'BIROPER_VILL' ,'biroper_id', 'vill_id');
    }
}
