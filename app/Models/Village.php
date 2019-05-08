<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $table = 'village';
    public $timestamps = false;

    //one to many
    public function akomodasi()
    {
      return $this->hasMany('App\Models\Akomodasi');
    }

    public function transportasi()
    {
      return $this->hasMany('App\Models\Transportasi');
    }

    public function objekWisata()
    {
      return $this->hasMany('App\Models\ObjekWisata');
    }

    public function sanggarWisata()
    {
      return $this->hasMany('App\Models\SanggarWisata');
    }

    public function pramuwisata()
    {
      return $this->hasMany('App\Models\Pramuwisata');
    }

    public function souvenir()
    {
      return $this->hasMany('App\Models\Souvenir');
    }

    // one to many (inverse)
    public function district()
    {
      return $this->belongsTo('App\Models\District');
    }

    //many to many
    public function ekonomiKreatif()
    {
      return $this->belongsToMany('App\Models\EkonomiKreatif', 'ekonomi_kreatif__village');
    }

    public function kuliner()
    {
      return $this->belongsToMany('App\Models\Kuliner', 'kuliner__village');
    }


}
