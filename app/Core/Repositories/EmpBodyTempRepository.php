<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\EmpBodyTempInterface;

use App\Models\EmpBodyTemp;


class EmpBodyTempRepository extends BaseRepository implements EmpBodyTempInterface {
	

    protected $emp_body_temp;


	public function __construct(EmpBodyTemp $emp_body_temp){

        $this->emp_body_temp = $emp_body_temp;
        parent::__construct();

    }




    // public function fetch($request){

    //     $key = str_slug($request->fullUrl(), '_');
    //     $entries = isset($request->e) ? $request->e : 20;

    //     $emp_body_temp_list = $this->cache->remember('emp_body_temp:fetch:' . $key, 240, function() use ($request, $entries){

    //         $emp_body_temp = $this->emp_body_temp->newQuery();
            
    //         if(isset($request->q)){
    //             $emp_body_temp->where('name', 'LIKE', '%'. $request->q .'%');
    //         }

    //         return $emp_body_temp->select('name', 'route', 'icon', 'slug')
    //                     ->sortable()
    //                     ->orderBy('updated_at', 'desc')
    //                     ->paginate($entries);

    //     });

    //     return $emp_body_temp_list;

    // }




    // public function store($request){

    //     $emp_body_temp = new EmpBodyTemp;
    //     $emp_body_temp->emp_body_temp_id = $this->getEmpBodyTempIdInc();
    //     $emp_body_temp->slug = $this->str->random(16);
    //     $emp_body_temp->name = $request->name;
    //     $emp_body_temp->route = $request->route;
    //     $emp_body_temp->icon = $request->icon;
    //     $emp_body_temp->is_emp_body_temp = $this->__dataType->string_to_boolean($request->is_emp_body_temp);
    //     $emp_body_temp->is_dropdown = $this->__dataType->string_to_boolean($request->is_dropdown);
    //     $emp_body_temp->created_at = $this->carbon->now();
    //     $emp_body_temp->updated_at = $this->carbon->now();
    //     $emp_body_temp->ip_created = request()->ip();
    //     $emp_body_temp->ip_updated = request()->ip();
    //     $emp_body_temp->user_created = $this->auth->user()->user_id;
    //     $emp_body_temp->user_updated = $this->auth->user()->user_id;
    //     $emp_body_temp->save();
        
    //     return $emp_body_temp;

    // }




    // public function update($request, $slug){

    //     $emp_body_temp = $this->findBySlug($slug);
    //     $emp_body_temp->name = $request->name;
    //     $emp_body_temp->route = $request->route;
    //     $emp_body_temp->icon = $request->icon;
    //     $emp_body_temp->is_emp_body_temp = $this->__dataType->string_to_boolean($request->is_emp_body_temp);
    //     $emp_body_temp->is_dropdown = $this->__dataType->string_to_boolean($request->is_dropdown);
    //     $emp_body_temp->updated_at = $this->carbon->now();
    //     $emp_body_temp->ip_updated = request()->ip();
    //     $emp_body_temp->user_updated = $this->auth->user()->user_id;
    //     $emp_body_temp->save();
        
    //     return $emp_body_temp;

    // }




    // public function destroy($slug){

    //     $emp_body_temp = $this->findBySlug($slug);
    //     $emp_body_temp->delete();

    //     return $emp_body_temp;

    // }




    // public function findBySlug($slug){

    //     $emp_body_temp = $this->cache->remember('emp_body_temp:findBySlug:' . $slug, 240, function() use ($slug){
    //         return $this->emp_body_temp->where('slug', $slug)->first();
    //     }); 
        
    //     if(empty($emp_body_temp)){
    //         abort(404);
    //     }

    //     return $emp_body_temp;

    // }




    // public function getEmpBodyTempIdInc(){

    //     $id = 'M10001';

    //     $emp_body_temp = $this->emp_body_temp->select('emp_body_temp_id')->orderBy('emp_body_temp_id', 'desc')->first();

    //     if($emp_body_temp != null){

    //         if($emp_body_temp->emp_body_temp_id != null){
    //             $num = str_replace('M', '', $emp_body_temp->emp_body_temp_id) + 1;
    //             $id = 'M' . $num;
    //         }
        
    //     }
        
    //     return $id;
        
    // }




}