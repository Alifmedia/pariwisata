<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanggarSeniFoto extends Model
{
    protected $table = 'sanggar_seni_foto';
    public $timestamps = false;

    public function sanggarSeni()
    {
      return $this->belongsTo('App\Models\SanggarSeni');
    }

}
