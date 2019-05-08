<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'ROLE';
    public $timestamps = false;

    //one to many
    public function user()
    {
      return $this->hasMany('App\Models\User');
    }
}
