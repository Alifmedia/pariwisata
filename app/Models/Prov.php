<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prov extends Model
{
    protected $table = 'PROV';
    protected $primaryKey = 'prov_id';
    public $timestamps = false;

    //one to many
    public function Regional()
    {
      return $this->hasMany('App\Models\Regional', 'prov_id', 'reg_id');
    }
}