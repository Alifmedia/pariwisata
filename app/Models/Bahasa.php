<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bahasa extends Model
{
    protected $table = 'bahasa';
    public $timestamps = false;

    public function pramuwisata()
    {
      return $this->belongsToMany('App\Models\Pramuwisata', 'pramuwisata__bahasa');
    }
}
