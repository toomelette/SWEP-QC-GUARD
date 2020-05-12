<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\JanitorMasterInterface;

use App\Models\JanitorMaster;


class JanitorMasterRepository extends BaseRepository implements JanitorMasterInterface {
	

    protected $janitor_master;


	public function __construct(JanitorMaster $janitor_master){
        $this->janitor_master = $janitor_master;
        parent::__construct();
    }



    public function getAll(){

        $janitors = $this->cache->remember('janitor_master:getAll', 240, function(){
            return $this->janitor_master->select('janitor_id', 'lastname', 'middlename', 'firstname', 'suffixname')->get();
        });
        
        return $janitors;

    }



}