<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pramuwisata extends Model
{
    protected $table = 'PRAMUWISATA';
    protected $primaryKey = 'pramu_id';
    public $timestamps = false;

    // one to many (inverse)
    public function Village()
    {
      return $this->belongsTo('App\Models\Village', 'pramu_id', 'vill_id');
    }
}
