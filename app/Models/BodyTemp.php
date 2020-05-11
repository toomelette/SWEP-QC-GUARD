<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class BodyTemp extends Model{


    use Sortable;

    protected $table = 'body_temp';
    protected $dates = ['created_at', 'updated_at'];
	public $timestamps = false;


    protected $attributes = [

        'slug' => '',
        'emp_id' => '',
        'cos_id' => '',
        'body_temp_id' => '',
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



    public function getFullnameAttribute(){

        if ($this->is_reg_emp == 1) {
            
            if ($this->empMaster) {
                return strtoupper($this->empMaster->firstname .' '. substr($this->empMaster->middlename , 0, 1) . '. ' . $this->empMaster->lastname .' '. $this->empMaster->suffixname); 
            }
            
        }elseif ($this->is_reg_emp == 0) {
            
            if ($this->cosMaster) {
                return strtoupper($this->cosMaster->fullname); 
            }
            
        }

        return "";

    }



    public function displayStatus(){

        $status = '';

        if ($this->status == 1) {

            $status = '<span class="badge bg-blue">BELOW NORMAL</span>';
            
        }elseif ($this->status == 2) {
            
            $status = '<span class="badge bg-green">NORMAL</span>';
            
        }elseif ($this->status == 3) {
            
            $status = '<span class="badge bg-red">ABOVE NORMAL</span>';
            
        }

        return $status;

    }



    public function getOriginIdAttribute(){

        $origin_id = '';

        if ($this->is_reg_emp == 1) {
            
            if ($this->empMaster) {
                $origin_id = $this->emp_id;
            }
            
        }elseif ($this->is_reg_emp == 0) {
            
            if ($this->cosMaster) {
                $origin_id = $this->cos_id;
            }
            
        }

        return $origin_id;

    }

    
    
}
