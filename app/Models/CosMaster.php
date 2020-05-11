<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class CosMaster extends Model{


    use Sortable;


    protected $table = 'cos_master';
    protected $dates = ['created_at', 'updated_at'];
	public $timestamps = false;


    protected $attributes = [

        'slug' => '',
        'cos_id' => '',
        'fullname' => '',
        'position' => '',
        'station' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];


    public function empBodyTemp() {
        return $this->hasMany('App\Models\EmpBodyTemp','cos_id','cos_id');
    }

    
}
