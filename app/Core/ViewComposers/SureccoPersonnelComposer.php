<?php

namespace App\Core\ViewComposers;

use View;
use App\Core\Interfaces\SureccoPersonnelInterface;


class SureccoPersonnelComposer{
   

	protected $sp_repo;


	public function __construct(SureccoPersonnelInterface $sp_repo){
		$this->sp_repo = $sp_repo;
	}



    public function compose($view){

        $surecco_personnels = $this->sp_repo->getAll();
    	$view->with('global_surecco_personnels_all', $surecco_personnels);

    }



}