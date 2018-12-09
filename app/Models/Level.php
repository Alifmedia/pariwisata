<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'level';
    protected $primaryKey = 'level_id';
    public $timestamps = false;

    public function TipeAkomodasi()
    {
      return $this->belongsToMany('App\Models\TipeAkomodasi', 'tipe_level' ,'level_id', 'tipe_id');
    }
}
