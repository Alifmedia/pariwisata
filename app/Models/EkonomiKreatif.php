<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EkonomiKreatif extends Model
{
    protected $table = 'EKONOMI_KREATIF';
    public $timestamps = false;

    //one to many
    public function ekonomiKreatifFoto()
    {
      return $this->hasMany('App\Models\EkonomiKreatifFoto');
    }

    // one to many (inverse)
    public function ekonomiKreatifBidang()
    {
      return $this->belongsTo('App\Models\EkonomiKreatifBidang');
    }

    //many to many
    public function village()
    {
      return $this->belongsTo('App\Models\Village');
    }
}
