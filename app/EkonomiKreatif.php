<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EkonomiKreatif extends Model
{
    protected $table = 'EKONOMI_KREATIF';
    protected $primaryKey = 'ekokrea_id';
    public $timestamps = false;

    //one to many
    public function Foto()
    {
      return $this->hasMany('App\Foto', 'ekokrea_id', 'foto_id');
    }

    // one to many (inverse)
    public function EkokreaBid()
    {
      return $this->belongsTo('App\EkokreaBid', 'ekokrea_id', 'ekokreabid_id');
    }

    //many to many
    public function Village()
    {
      return $this->belongsToMany('App\Village', 'EKOKREA_VILL' ,'ekokrea_id', 'vill_id');
    }
}
