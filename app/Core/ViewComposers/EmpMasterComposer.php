<?php

namespace App\Core\ViewComposers;

use View;
use App\Core\Interfaces\EmpMasterInterface;


class EmpMasterComposer{
   

	protected $emp_master_repo;


	public function __construct(EmpMasterInterface $emp_master_repo){
		$this->emp_master_repo = $emp_master_repo;
	}



    public function compose($view){

        $employees = $this->emp_master_repo->getAll();
    	$view->with('global_employees_all', $employees);

    }



}