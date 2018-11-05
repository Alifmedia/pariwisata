<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regional extends Model
{
    protected $table = 'REGIONAL';
    protected $primaryKey = 'reg_id';
    public $timestamps = false;

    //one to many
    public function District()
    {
      return $this->hasMany('App\District', 'reg_id', 'dist_id');
    }

    // one to many (inverse)
    public function Prov()
    {
      return $this->belongsTo('App\Prov', 'reg_id', 'prov_id');
    }
}
