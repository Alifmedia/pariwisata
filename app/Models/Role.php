<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'ROLE';
    protected $primaryKey = 'role_id';
    public $timestamps = false;

    //one to many
    public function User()
    {
      return $this->hasMany('App\Models\User', 'role_id', 'user_id');
    }
}
