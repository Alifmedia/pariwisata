<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanggarWisata extends Model
{
    protected $table = 'SANGGAR_WISATA';
    protected $primaryKey = 'sanggar_id';
    public $timestamps = false;

    // one to many (inverse)
    public function Village()
    {
      return $this->belongsTo('App\Models\Village', 'sanggar_id', 'vill_id');
    }

}
