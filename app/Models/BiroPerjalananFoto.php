<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BiroPerjalananFoto extends Model
{
    protected $table = 'biro_perjalanan_foto';
    public $timestamps = false;

    public function kuliner()
    {
      return $this->belongsTo('App\Models\BiroPerjalanan', 'biro_perjalanan_id');
    }

}
