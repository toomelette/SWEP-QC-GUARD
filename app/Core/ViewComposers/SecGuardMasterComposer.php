<?php

namespace App\Core\ViewComposers;

use View;
use App\Core\Interfaces\SecGuardMasterInterface;


class SecGuardMasterComposer{
   

	protected $sec_guard_master_repo;


	public function __construct(SecGuardMasterInterface $sec_guard_master_repo){
		$this->sec_guard_master_repo = $sec_guard_master_repo;
	}



    public function compose($view){

        $sec_guards = $this->sec_guard_master_repo->getAll();
    	$view->with('global_sec_guard_all', $sec_guards);

    }



}