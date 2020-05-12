<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SecGuardMasterInterface;

use App\Models\SecGuardMaster;


class SecGuardMasterRepository extends BaseRepository implements SecGuardMasterInterface {
	

    protected $sec_guard_master;


	public function __construct(SecGuardMaster $sec_guard_master){
        $this->sec_guard_master = $sec_guard_master;
        parent::__construct();
    }



    public function getAll(){

        $sec_guards = $this->cache->remember('sec_guard_master:getAll', 240, function(){
            return $this->sec_guard_master->select('sec_guard_id', 'lastname', 'middlename', 'firstname', 'suffixname')->get();
        });
        
        return $sec_guards;

    }



}