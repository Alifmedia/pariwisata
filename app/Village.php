<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $table = 'VILLAGE';
    protected $primaryKey = 'vill_id';
    public $timestamps = false;

    //one to many
    public function Akomodasi()
    {
      return $this->hasMany('App\Akomodasi', 'vill_id', 'akom_id');
    }

    public function Transportasi()
    {
      return $this->hasMany('App\Transportasi', 'vill_id', 'trans_id');
    }

    public function ObjekWisata()
    {
      return $this->hasMany('App\ObjekWisata', 'vill_id', 'objwis_id');
    }

    public function SanggarWisata()
    {
      return $this->hasMany('App\SanggarWisata', 'vill_id', 'sanggar_id');
    }

    public function Pramuwisata()
    {
      return $this->hasMany('App\Pramuwisata', 'vill_id', 'pramu_id');
    }

    public function Souvenir()
    {
      return $this->hasMany('App\Souvenir', 'vill_id', 'souv_id');
    }

    // one to many (inverse)
    public function District()
    {
      return $this->belongsTo('App\District', 'vill_id', 'dist_id');
    }

    //many to many
    public function EkonomiKreatif()
    {
      return $this->belongsToMany('App\EkonomiKreatif', 'EKOKREA_VILL' ,'vill_id', 'ekokrea_id');
    }

    public function Kuliner()
    {
      return $this->belongsToMany('App\Kuliner', 'KULL_VILL' ,'vill_id', 'kul_id');
    }

    public function BiroPerjalanan()
    {
      return $this->belongsToMany('App\BiroPerjalanan', 'BIROPER_VILL' ,'vill_id', 'biroper_id');
    }


}
