<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SecGuardMaster extends Model{


    use Sortable;


    protected $table = 'sec_guard_master';
    protected $dates = ['created_at', 'updated_at'];
	public $timestamps = false;


    protected $attributes = [

        'slug' => '',
        'sec_guard_id' => '',
        'lastname' => '',
        'firstname' => '',
        'middlename' => '',
        'suffixname' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];



    public function empBodyTemp() {
        return $this->hasMany('App\Models\EmpBodyTemp','sec_guard_id','sec_guard_id');
    }


    public function getFullnameAttribute(){
        return strtoupper($this->firstname .' '. substr($this->middlename , 0, 1) . '. ' . $this->lastname .' '. $this->suffixname);
    }

    
}
