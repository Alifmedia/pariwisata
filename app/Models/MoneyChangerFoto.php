<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoneyChangerFoto extends Model
{
    protected $table = 'money_changer_foto';
    public $timestamps = false;

    public function moneyChanger()
    {
      return $this->belongsTo('App\Models\MoneyChanger');
    }

}
