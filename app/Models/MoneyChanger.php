<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoneyChanger extends Model
{
    protected $table = 'money_changer';
    public $timestamps = false;

    //one to many
    public function moneyChangerFoto()
    {
      return $this->hasMany('App\Models\MoneyChangerFoto');
    }

    // one to many (inverse)
    public function village()
    {
      return $this->belongsTo('App\Models\Village');
    }
}
