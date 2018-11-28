<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataHunian extends Model
{
  protected $table = 'DATA_HUNIAN';
  protected $primaryKey = 'dathuni_id';
  public $timestamps = false;

  // one to many (inverse)
  public function Akomodasi()
  {
    return $this->belongsTo('App\Models\Akomodasi', 'dathuni_id', 'akom_id');
  }
  public function User()
  {
    return $this->belongsTo('App\Models\User', 'dathuni_id', 'user_id');
  }

}
