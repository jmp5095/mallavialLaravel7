<?php
namespace App\permisos\traits;

trait UserTrait{
  //inicio
  public function roles(){
    return $this->belongsToMany('App\permisos\models\Role')->withTimesTamps();
  }

  public function havePermission($permission){
    foreach ($this->roles as $role) {
      if ($role['full-access']=='yes') {
        return true;
      }

      foreach ($role->permissions as $perm) {
        if ($perm['slug']==$permission) {
          return true;
        }
      }
    }

    return false;

  }
}
