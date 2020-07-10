<?php

namespace App\permisos\models;

use Illuminate\Database\Eloquent\Model;

class IdentificationsType extends Model
{
    protected $fillable=[
      'name', 'description',
    ];

    public function users()
      {
          return $this->hasMany('App\User');
      }
}
