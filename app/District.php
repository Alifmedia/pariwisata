<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'DISTRICT';
    protected $primaryKey = 'dist_id';
    public $timestamps = false;

    //one to many
    public function Village()
    {
      return $this->hasMany('App\Village', 'dist_id', 'vill_id');
    }

    // one to many (inverse)
    public function Regional()
    {
      return $this->belongsTo('App\Regional', 'dist_id', 'reg_id');
    }
    
}
