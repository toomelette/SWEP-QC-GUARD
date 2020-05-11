<?php

namespace App\Core\ViewComposers;

use View;
use App\Core\Interfaces\CosMasterInterface;


class CosMasterComposer{
   

	protected $cos_master_repo;


	public function __construct(CosMasterInterface $cos_master_repo){
		$this->cos_master_repo = $cos_master_repo;
	}



    public function compose($view){

        $cos = $this->cos_master_repo->getAll();
    	$view->with('global_cos_all', $cos);

    }



}