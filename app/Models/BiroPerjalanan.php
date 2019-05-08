<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BiroPerjalanan extends Model
{
    protected $table = 'BIRO_PERJALANAN';
    public $timestamps = false;

    //one to many
    public function biroPerjalananFoto()
    {
      return $this->hasMany('App\Models\BiroPerjalananFoto', 'biro_perjalanan_id');
    }

    //many to many
    public function village()
    {
      return $this->belongsTo('App\Models\Village');
    }
}
