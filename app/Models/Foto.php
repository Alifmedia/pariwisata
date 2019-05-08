<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
  protected $table = 'FOTO';
  public $timestamps = false;

  // one to many (inverse)
  public function Kuliner()
  {
    return $this->belongsTo('App\Models\Kuliner');
  }

  public function ObjekWisata()
  {
    return $this->belongsTo('App\Models\ObjekWisata');
  }

  public function EkonomiKreatif()
  {
    return $this->belongsTo('App\Models\EkonomiKreatif');
  }

  public function BiroPerjalanan()
  {
    return $this->belongsTo('App\Models\BiroPerjalanan');
  }

  public function Akomodasi()
  {
    return $this->belongsTo('App\Models\Akomodasi');
  }

  public function Transportasi()
  {
    return $this->belongsTo('App\Models\Transportasi');
  }

  public function Souvenir()
  {
    return $this->belongsTo('App\Models\Souvenir');
  }

}
