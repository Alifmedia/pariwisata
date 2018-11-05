<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
  protected $table = 'FOTO';
  protected $primaryKey = 'foto_id';
  public $timestamps = false;

  // one to many (inverse)
  public function Kuliner()
  {
    return $this->belongsTo('App\Kuliner', 'foto_id', 'kul_id');
  }

  public function ObjekWisata()
  {
    return $this->belongsTo('App\ObjekWisata', 'foto_id', 'objwis_id');
  }

  public function EkonomiKreatif()
  {
    return $this->belongsTo('App\EkonomiKreatif', 'foto_id', 'ekokrea_id');
  }

  public function BiroPerjalanan()
  {
    return $this->belongsTo('App\BiroPerjalanan', 'foto_id', 'biroper_id');
  }

  public function Akomodasi()
  {
    return $this->belongsTo('App\Akomodasi', 'foto_id', 'akom_id');
  }

  public function Transportasi()
  {
    return $this->belongsTo('App\Transportasi', 'foto_id', 'trans_id');
  }

  public function Souvenir()
  {
    return $this->belongsTo('App\Souvenir', 'foto_id', 'souv_id');
  }

}
