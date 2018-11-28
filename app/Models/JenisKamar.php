<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisKamar extends Model
{
    protected $table = 'JENIS_KAMAR';
    protected $primaryKey = 'jenkam_id';
    public $timestamps = false;

    //many to many
    public function Akomodasi()
    {
      return $this->belongsToMany('App\Models\Akomodasi', 'DISTRIBUSI_KAMAR', 'jenkam_id' ,'akom_id');
    }
}
