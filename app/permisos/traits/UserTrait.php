<?php
namespace App\permisos\traits;

trait UserTrait{
  //inicio
  public function roles(){
    return $this->hasOne('App\permisos\models\Role','id','role_id');
  }
  public function identification_type(){
    return $this->hasOne('App\permisos\models\IdentificationsType','id','identification_type_id');
  }

  public function havePermission($permission){

      if ($this->roles['full-access']=='yes') {
        return true;
      }

      foreach ($this->roles->permissions as $perm) {
        if ($perm['slug']==$permission) {
          return true;
        }
      }

    return false;

  }
}
