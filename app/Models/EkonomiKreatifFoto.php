<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EkonomiKreatifFoto extends Model
{
    protected $table = 'ekonomi_kreatif_foto';
    public $timestamps = false;

    public function ekonomiKreatif()
    {
      return $this->belongsTo('App\Models\EkonomiKreatif');
    }

}
