<?php

namespace App\Core\ViewComposers;

use View;
use App\Core\Interfaces\JanitorMasterInterface;


class JanitorMasterComposer{
   

	protected $janitor_master_repo;


	public function __construct(JanitorMasterInterface $janitor_master_repo){
		$this->janitor_master_repo = $janitor_master_repo;
	}



    public function compose($view){

        $janitors = $this->janitor_master_repo->getAll();
    	$view->with('global_janitor_all', $janitors);

    }



}