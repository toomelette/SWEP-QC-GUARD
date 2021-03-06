<?php

namespace App\Providers;
 
use Illuminate\Support\ServiceProvider;
 

class RepositoryServiceProvider extends ServiceProvider {
	


	public function register(){

		$this->app->bind('App\Core\Interfaces\UserInterface', 'App\Core\Repositories\UserRepository');

		$this->app->bind('App\Core\Interfaces\UserMenuInterface', 'App\Core\Repositories\UserMenuRepository');

		$this->app->bind('App\Core\Interfaces\UserSubmenuInterface', 'App\Core\Repositories\UserSubmenuRepository');


		$this->app->bind('App\Core\Interfaces\MenuInterface', 'App\Core\Repositories\MenuRepository');

		$this->app->bind('App\Core\Interfaces\SubmenuInterface', 'App\Core\Repositories\SubmenuRepository');

		$this->app->bind('App\Core\Interfaces\ProfileInterface', 'App\Core\Repositories\ProfileRepository');

		$this->app->bind('App\Core\Interfaces\BodyTempInterface', 'App\Core\Repositories\BodyTempRepository');

		$this->app->bind('App\Core\Interfaces\EmpMasterInterface', 'App\Core\Repositories\EmpMasterRepository');

		$this->app->bind('App\Core\Interfaces\CosMasterInterface', 'App\Core\Repositories\CosMasterRepository');

		$this->app->bind('App\Core\Interfaces\JanitorMasterInterface', 'App\Core\Repositories\JanitorMasterRepository');

		$this->app->bind('App\Core\Interfaces\SecGuardMasterInterface', 'App\Core\Repositories\SecGuardMasterRepository');

		$this->app->bind('App\Core\Interfaces\SureccoPersonnelInterface', 'App\Core\Repositories\SureccoPersonnelRepository');
		
	}



}