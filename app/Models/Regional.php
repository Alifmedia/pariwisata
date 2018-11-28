<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regional extends Model
{
    protected $table = 'REGIONAL';
    protected $primaryKey = 'reg_id';
    public $timestamps = false;

    //one to many
    public function District()
    {
      return $this->hasMany('App\Models\District', 'reg_id', 'dist_id');
    }

    // one to many (inverse)
    public function Prov()
    {
      return $this->belongsTo('App\Models\Prov', 'reg_id', 'prov_id');
    }
}
