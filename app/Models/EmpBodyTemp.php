<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class EmpBodyTemp extends Model{


    use Sortable;

    protected $table = 'emp_body_temp';
    protected $dates = ['created_at', 'updated_at'];
	public $timestamps = false;


    protected $attributes = [

        'slug' => '',
        'emp_id' => '',
        'cos_id' => '',
        'emp_body_temp_id' => '',
        'status' => 0,
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];



    /** RELATIONSHIPS **/
    public function empMaster() {
    	return $this->belongsTo('App\Models\EmpMaster','emp_id','emp_id');
   	}


    public function cosMaster() {
        return $this->belongsTo('App\Models\CosMaster','cos_id','cos_id');
    }

    
    
}
