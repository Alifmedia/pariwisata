<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $table = 'VILLAGE';
    protected $primaryKey = 'vill_id';
    public $timestamps = false;

    //one to many
    public function Akomodasi()
    {
      return $this->hasMany('App\Models\Akomodasi', 'vill_id', 'akom_id');
    }

    public function Transportasi()
    {
      return $this->hasMany('App\Models\Transportasi', 'vill_id', 'trans_id');
    }

    public function ObjekWisata()
    {
      return $this->hasMany('App\Models\ObjekWisata', 'vill_id', 'objwis_id');
    }

    public function SanggarWisata()
    {
      return $this->hasMany('App\Models\SanggarWisata', 'vill_id', 'sanggar_id');
    }

    public function Pramuwisata()
    {
      return $this->hasMany('App\Models\Pramuwisata', 'vill_id', 'pramu_id');
    }

    public function Souvenir()
    {
      return $this->hasMany('App\Models\Souvenir', 'vill_id', 'souv_id');
    }

    // one to many (inverse)
    public function District()
    {
      return $this->belongsTo('App\Models\District', 'vill_id', 'dist_id');
    }

    //many to many
    public function EkonomiKreatif()
    {
      return $this->belongsToMany('App\Models\EkonomiKreatif', 'EKOKREA_VILL' ,'vill_id', 'ekokrea_id');
    }

    public function Kuliner()
    {
      return $this->belongsToMany('App\Models\Kuliner', 'KULL_VILL' ,'vill_id', 'kul_id');
    }

    public function BiroPerjalanan()
    {
      return $this->belongsToMany('App\Models\BiroPerjalanan', 'BIROPER_VILL' ,'vill_id', 'biroper_id');
    }


}
