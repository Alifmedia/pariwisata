<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pramuwisata extends Model
{
    protected $table = 'PRAMUWISATA';
    public $timestamps = false;

    // one to many (inverse)
    public function village()
    {
      return $this->belongsTo('App\Models\Village');
    }

    public function bahasa()
    {
      return $this->belongsToMany('App\Models\Bahasa', 'pramuwisata__bahasa');
    }
}
