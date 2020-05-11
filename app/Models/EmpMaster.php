<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class EmpMaster extends Model{


    use Sortable;


    protected $table = 'emp_master';
    protected $dates = ['birthday', 'firstday', 'created_at', 'updated_at'];
	public $timestamps = false;


    protected $attributes = [

        'slug' => '',
        'emp_id' => '',
        'department_id' => '',
        'division_id' => '',
        'emp_no' => '',
        'firstname' => '',
        'middlename' => '',
        'lastname' => '',
        'suffixname' => '',
        'birthday' => null,
        'sex' => '',
        'civil_status' => '',
        'height' => '',
        'weight' => '',
        'blood_type' => '',
        'position' => '',
        'firstday' => null,
        'philhealth_no' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];


    public function empBodyTemp() {
        return $this->hasMany('App\Models\EmpBodyTemp','emp_id','emp_id');
    }



    public function getFullnameAttribute(){
        return strtoupper($this->firstname .' '. substr($this->middlename , 0, 1) . '. ' . $this->lastname .' '. $this->suffixname);
    }
	
    
}
