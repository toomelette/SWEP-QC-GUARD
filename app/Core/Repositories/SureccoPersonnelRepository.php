<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SureccoPersonnelInterface;

use App\Models\SureccoPersonnel;


class SureccoPersonnelRepository extends BaseRepository implements SureccoPersonnelInterface {
	

    protected $surecco_personnel;


	public function __construct(SureccoPersonnel $surecco_personnel){
        $this->surecco_personnel = $surecco_personnel;
        parent::__construct();
    }



    public function getAll(){

        $surecco_personnels = $this->cache->remember('surecco_personnels:getAll', 240, function(){
            return $this->surecco_personnel->select('sp_id', 'fullname')->get();
        });
        
        return $surecco_personnels;

    }



}