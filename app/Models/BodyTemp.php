<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class BodyTemp extends Model{


    use Sortable;

    protected $table = 'body_temp';
    protected $dates = ['created_at', 'updated_at'];
	public $timestamps = false;


    // 1 = Regular
    // 2 = COS
    // 3 = Janitor 
    // 4 = Security Guard


    protected $attributes = [

        'slug' => '',
        'emp_id' => '',
        'cos_id' => '',
        'janitor_id' => '',
        'sec_guard_id' => '',
        'body_temp_id' => '',
        'cat' => 0,
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


    public function janitorMaster() {
        return $this->belongsTo('App\Models\JanitorMaster','janitor_id','janitor_id');
    }


    public function secGuardMaster() {
        return $this->belongsTo('App\Models\SecGuardMaster','sec_guard_id','sec_guard_id');
    }



    public function getFullnameAttribute(){

        $fullname = "";

        if ($this->cat == 1) {
            
            if ($this->empMaster) {
                $fullname = strtoupper($this->empMaster->fullname); 
            }
            
        }elseif ($this->cat == 2) {
            
            if ($this->cosMaster) {
                $fullname = strtoupper($this->cosMaster->fullname); 
            }
            
        }elseif ($this->cat == 3) {
            
            if ($this->janitorMaster) {
                $fullname = strtoupper($this->janitorMaster->fullname); 
            }
            
        }elseif ($this->cat == 4) {
            
            if ($this->secGuardMaster) {
                $fullname = strtoupper($this->secGuardMaster->fullname); 
            }
            
        }

        return $fullname;

    }



    public function displayStatus(){

        $status = '';

        if ($this->status == 1) {
            $status = '<span class="badge bg-blue">BELOW NORMAL</span>';
        }elseif ($this->status == 2) {
            $status = '<span class="badge bg-green">NORMAL</span>';
        }elseif ($this->status == 3) {
            $status = '<span class="badge bg-orange">ABOVE NORMAL</span>';
        }elseif ($this->status == 4) {
            $status = '<span class="badge bg-red">Fever</span>';
        }

        return $status;

    }



    public function getOriginIdAttribute(){

        $cat = '';

        if ($this->cat == 1) {
            
            if ($this->empMaster) {
                $cat = $this->emp_id;
            }
            
        }elseif ($this->cat == 2) {
            
            if ($this->cosMaster) {
                $cat = $this->cos_id;
            }
            
        }elseif ($this->cat == 3) {
            
            if ($this->janitorMaster) {
                $cat = $this->janitor_id;
            }
            
        }elseif ($this->cat == 4) {
            
            if ($this->secGuardMaster) {
                $cat = $this->sec_guard_id;
            }
            
        }

        return $cat;

    }

    
    
}
