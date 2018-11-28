<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'password', 'alamat', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'USER';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    //one to many
    public function DataKunjungan()
    {
      return $this->hasMany('App\Models\DataKunjungan', 'user_id', 'datkun_id');
    }

    public function DataHunian()
    {
      return $this->hasMany('App\Models\DataHunian', 'user_id', 'dathuni_id');
    }

    // one to many (inverse)
    public function Role()
    {
      return $this->belongsTo('App\Models\Role', 'user_id', 'role_id');
    }
}
