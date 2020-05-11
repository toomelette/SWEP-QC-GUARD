<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\CosMasterInterface;

use App\Models\CosMaster;


class CosMasterRepository extends BaseRepository implements CosMasterInterface {
	

    protected $cos_master;


	public function __construct(CosMaster $cos_master){
        $this->cos_master = $cos_master;
        parent::__construct();
    }



    public function getAll(){

        $cos = $this->cache->remember('cos_master:getAll', 240, function(){
            return $this->cos_master->select('cos_id', 'fullname')->get();
        });
        
        return $cos;

    }



}