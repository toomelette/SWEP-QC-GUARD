<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class JanitorMaster extends Model{


    use Sortable;


    protected $table = 'janitor_master';
    protected $dates = ['created_at', 'updated_at'];
	public $timestamps = false;


    protected $attributes = [

        'slug' => '',
        'janitor_id' => '',
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
        return $this->hasMany('App\Models\EmpBodyTemp','janitor_id','janitor_id');
    }


    public function getFullnameAttribute(){
        return strtoupper($this->firstname .' '. substr($this->middlename , 0, 1) . '. ' . $this->lastname .' '. $this->suffixname);
    }

    
}
