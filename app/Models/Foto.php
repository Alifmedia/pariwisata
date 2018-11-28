<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
  protected $table = 'FOTO';
  protected $primaryKey = 'foto_id';
  public $timestamps = false;

  // one to many (inverse)
  public function Kuliner()
  {
    return $this->belongsTo('App\Models\Kuliner', 'foto_id', 'kul_id');
  }

  public function ObjekWisata()
  {
    return $this->belongsTo('App\Models\ObjekWisata', 'foto_id', 'objwis_id');
  }

  public function EkonomiKreatif()
  {
    return $this->belongsTo('App\Models\EkonomiKreatif', 'foto_id', 'ekokrea_id');
  }

  public function BiroPerjalanan()
  {
    return $this->belongsTo('App\Models\BiroPerjalanan', 'foto_id', 'biroper_id');
  }

  public function Akomodasi()
  {
    return $this->belongsTo('App\Models\Akomodasi', 'foto_id', 'akom_id');
  }

  public function Transportasi()
  {
    return $this->belongsTo('App\Models\Transportasi', 'foto_id', 'trans_id');
  }

  public function Souvenir()
  {
    return $this->belongsTo('App\Models\Souvenir', 'foto_id', 'souv_id');
  }

}
