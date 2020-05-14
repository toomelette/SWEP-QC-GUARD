<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SureccoPersonnel extends Model{


    use Sortable;


    protected $table = 'surecco_personnels';
    protected $dates = ['created_at', 'updated_at'];
	public $timestamps = false;


    protected $attributes = [

        'slug' => '',
        'sp_id' => '',
        'fullname' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];



    public function empBodyTemp() {
        return $this->hasMany('App\Models\EmpBodyTemp','sp_id','sp_id');
    }

    
}
