<?php

namespace App\permisos\models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  //inicio

  protected $fillable = [
      'name', 'description', 'full-access',
  ];

  // public function users(){
  //   return $this->belongsToMany('App\User')->withTimesTamps();
  // }

  public function permissions(){
    return $this->belongsToMany('App\permisos\models\Permission')->withTimesTamps();
  }
}
