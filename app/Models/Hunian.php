<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hunian extends Model
{
  protected $table = 'hunian';
  public $timestamps = false;

  // one to many (inverse)
  public function akomodasi()
  {
    return $this->belongsTo('App\Models\Akomodasi');
  }
  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

}
