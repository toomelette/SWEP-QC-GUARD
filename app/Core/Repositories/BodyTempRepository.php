<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\BodyTempInterface;

use App\Models\BodyTemp;


class BodyTempRepository extends BaseRepository implements BodyTempInterface {
	

    protected $body_temp;


	public function __construct(BodyTemp $body_temp){

        $this->body_temp = $body_temp;
        parent::__construct();

    }




    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $body_temp_list = $this->cache->remember('body_temp:fetch:' . $key, 240, function() use ($request, $entries){

            $body_temp = $this->body_temp->newQuery();
            
            if(isset($request->q)){
                $body_temp->whereHas('empMaster', function ($model) use ($request) {
                                $model->where('firstname', 'LIKE', '%'. $request->q .'%')
                                      ->orWhere('middlename', 'LIKE', '%'. $request->q .'%')
                                      ->orWhere('lastname', 'LIKE', '%'. $request->q .'%')
                                      ->orWhere('emp_no', 'LIKE', '%'. $request->q .'%');
                           })
                           ->orWhereHas('cosMaster', function ($model) use ($request) {
                                $model->where('fullname', 'LIKE', '%'. $request->q .'%');
                           })
                           ->orWhereHas('janitorMaster', function ($model) use ($request) {
                                $model->where('firstname', 'LIKE', '%'. $request->q .'%')
                                      ->orWhere('middlename', 'LIKE', '%'. $request->q .'%')
                                      ->orWhere('lastname', 'LIKE', '%'. $request->q .'%');
                           })
                           ->orWhereHas('secGuardMaster', function ($model) use ($request) {
                                $model->where('firstname', 'LIKE', '%'. $request->q .'%')
                                      ->orWhere('middlename', 'LIKE', '%'. $request->q .'%')
                                      ->orWhere('lastname', 'LIKE', '%'. $request->q .'%');
                           });
            }

            return $body_temp->select('emp_id', 'cos_id', 'janitor_id', 'sec_guard_id', 'cat', 'status', 'created_at', 'slug')
                             ->sortable()
                             ->orderBy('updated_at', 'desc')
                             ->paginate($entries);

        });

        return $body_temp_list;

    }




    public function store($request){

        $id = substr($request->id, 0, 1);

        $body_temp = new BodyTemp;
        $body_temp->slug = $this->str->random(16);
        $body_temp->body_temp_id = $this->getBodyTempIdInc();
        
        if ($id == 'E') {
            $body_temp->emp_id = $request->id;
            $body_temp->cat = 1;
        }elseif($id == 'C'){
            $body_temp->cos_id = $request->id;
            $body_temp->cat = 2;
        }elseif($id == 'J'){
            $body_temp->janitor_id = $request->id;
            $body_temp->cat = 3;
        }elseif($id == 'S'){
            $body_temp->sec_guard_id = $request->id;
            $body_temp->cat = 4;
        }

        $body_temp->status = $request->status;
        $body_temp->created_at = $this->carbon->now();
        $body_temp->updated_at = $this->carbon->now();
        $body_temp->ip_created = request()->ip();
        $body_temp->ip_updated = request()->ip();
        $body_temp->user_created = $this->auth->user()->user_id;
        $body_temp->user_updated = $this->auth->user()->user_id;
        $body_temp->save();
        
        return $body_temp;

    }




    public function update($request, $slug){

        $body_temp = $this->findBySlug($slug);
        
        $id = substr($request->id, 0, 1);
        
        if ($id == 'E') {
            $body_temp->emp_id = $request->id;
            $body_temp->cat = 1;
        }elseif($id == 'C'){
            $body_temp->cos_id = $request->id;
            $body_temp->cat = 2;
        }elseif($id == 'J'){
            $body_temp->janitor_id = $request->id;
            $body_temp->cat = 3;
        }elseif($id == 'S'){
            $body_temp->sec_guard_id = $request->id;
            $body_temp->cat = 4;
        }

        $body_temp->status = $request->status;
        $body_temp->updated_at = $this->carbon->now();
        $body_temp->ip_updated = request()->ip();
        $body_temp->user_updated = $this->auth->user()->user_id;
        $body_temp->save();
        
        return $body_temp;

    }




    public function destroy($slug){

        $body_temp = $this->findBySlug($slug);
        $body_temp->delete();

        return $body_temp;

    }




    public function findBySlug($slug){

        $body_temp = $this->cache->remember('body_temp:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->body_temp->where('slug', $slug)->first();
        }); 
        
        if(empty($body_temp)){
            abort(404);
        }

        return $body_temp;

    }




    public function getBodyTempIdInc(){

        $id = 'BT10001';

        $body_temp = $this->body_temp->select('body_temp_id')->orderBy('body_temp_id', 'desc')->first();

        if($body_temp != null){

            if($body_temp->body_temp_id != null){
                $num = str_replace('BT', '', $body_temp->body_temp_id) + 1;
                $id = 'BT' . $num;
            }
        
        }
        
        return $id;
        
    }




}