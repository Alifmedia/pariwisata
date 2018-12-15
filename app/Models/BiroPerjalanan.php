<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BiroPerjalanan extends Model
{
    protected $table = 'BIRO_PERJALANAN';
    protected $primaryKey = 'biroper_id';
    public $timestamps = false;

    //one to many
    public function Foto()
    {
      return $this->hasMany('App\Models\Foto', 'biroper_id', 'foto_id');
    }

    //many to many
    public function Village()
    {
      return $this->belongsTo('App\Models\Village', 'biroper_id', 'vill_id');
    }
}
