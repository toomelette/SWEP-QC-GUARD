<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\EmpMasterInterface;

use App\Models\EmpMaster;


class EmpMasterRepository extends BaseRepository implements EmpMasterInterface {
	

    protected $emp_master;


	public function __construct(EmpMaster $emp_master){
        $this->emp_master = $emp_master;
        parent::__construct();
    }



    public function getAll(){

        $employees = $this->cache->remember('emp_master:getAll', 240, function(){
            return $this->emp_master->select('emp_id', 'firstname', 'middlename', 'lastname', 'suffixname')
                                    ->get();
        });
        
        return $employees;

    }



}