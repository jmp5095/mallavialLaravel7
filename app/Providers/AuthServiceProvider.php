<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
//inicio
use App\User;
Use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */

    public function boot()
    {
        $this->registerPolicies();

        //inicio
      //   Gate::define('update-post', 'App\Policies\PostPolicy@update');
        Gate::define('haveaccess', function(User $user,$perm){
          // dd($user->roles);
          return $user->havePermission($perm);
        });
    }

}
