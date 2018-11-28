<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EkokreaBid extends Model
{
    protected $table = 'EKOKREA_BID';
    protected $primaryKey = 'ekokreabid_id';
    public $timestamps = false;

    //one to many
    public function EkonomiKreatif()
    {
      return $this->hasMany('App\Models\EkonomiKreatif', 'ekokreabid_id', 'ekokrea_id');
    }
}
