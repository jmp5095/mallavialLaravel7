<?php

namespace App\permisos\models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
  //inicio
  protected $fillable = [
      'name', 'slug', 'description', 
  ];
  public function roles(){
    return $this->belongsToMany('App\permisos\models\Role')->withTimesTamps();
  }
}
