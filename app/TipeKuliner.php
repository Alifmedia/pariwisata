<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipeKuliner extends Model
{
    protected $table = 'TIPE_KULINER';
    protected $primaryKey = 'tipkul_id';
    public $timestamps = false;

    //one to many
    public function Kuliner()
    {
      return $this->hasMany('App\Kuliner', 'tipkul_id', 'kul_id');
    }
}
