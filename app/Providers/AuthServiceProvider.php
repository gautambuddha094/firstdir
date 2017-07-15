<?php

namespace App\Providers;
use App\Permission;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
        if (php_sapi_name() === 'cli' or defined('STDIN')) {
            //remove the error which comes during the execution command using CLI
        } else {
			foreach( $this->getPermissions() as $permission) {
				$gate->define($permission->name, function($user) use($permission){
					return $user->hasRole($permission->roles);
				});
			}
		}
    }
	
	/**
     * Function for return the permission on the basis of role.
     *
     * @return Permission
     */
	protected function getPermissions(){
		return Permission::with('roles')->get();
	}
}
