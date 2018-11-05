<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipeAkomodasi extends Model
{
    protected $table = 'TIPE_AKOM';
    protected $primaryKey = 'tipe_id';
    public $timestamps = false;

    //one to many
    public function Akomodasi()
    {
      return $this->hasMany('App\Akomodasi', 'tipe_id', 'akom_id');
    }
}
