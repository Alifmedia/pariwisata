<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EkonomiKreatifBidang extends Model
{
    protected $table = 'ekonomi_kreatif_bidang';
    public $timestamps = false;

    //one to many
    public function ekonomiKreatif()
    {
      return $this->hasMany('App\Models\EkonomiKreatif');
    }
}
