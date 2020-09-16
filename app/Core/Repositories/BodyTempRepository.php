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
                
            $df = $this->__dataType->date_parse($request->df);
            $dt = $this->__dataType->date_parse($request->dt);

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

            if(isset($request->df) || isset($request->dt)){
                $body_temp->whereBetween('date',[$df,$dt]);
            }

            return $body_temp->select('emp_id', 'cos_id', 'janitor_id', 'sec_guard_id', 'sp_id', 'cat', 'status', 'date', 'slug')
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
        }elseif($id == 'O'){
            $body_temp->sp_id = $request->id;
            $body_temp->cat = 5;
        }

        $body_temp->status = $request->status;
        $body_temp->date = $this->__dataType->date_parse($request->date);
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
          }elseif($id == 'O'){
              $body_temp->sp_id = $request->id;
              $body_temp->cat = 5;
          }

        $body_temp->date = $this->__dataType->date_parse($request->date);
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




    public function getByPersonnelId($p_id){

        $body_temp = $this->cache->remember('body_temp:getByPersonnel:' . $p_id, 240, function() use ($p_id){
                
            $id = substr($p_id, 0, 1);

            $body_temp_list = [];

            if ($id == 'E') {
                return $this->body_temp->where('emp_id', $p_id)->get();
            }elseif($id == 'C'){
                return $this->body_temp->where('cos_id', $p_id)->get();
            }elseif($id == 'J'){
                return $this->body_temp->where('janitor_id', $p_id)->get();
            }elseif($id == 'S'){
                return $this->body_temp->where('sec_guard_id', $p_id)->get();
            }elseif($id == 'O'){
                return $this->body_temp->where('sp_id', $p_id)->get();
            }


            return $body_temp_list;

        }); 

        return $body_temp;

    }




    public function countByDateStatus($df, $dt, $status){

        $body_temp = $this->cache->remember('body_temp:countByDateStatus:'.$df.'-'.$dt.'-'.$status, 240, function() use ($df, $dt,$status){

            $emp = $this->body_temp->select('emp_id')
                                    ->whereBetween('date', [$df,$dt])
                                    ->where('status', $status)
                                    ->where('cos_id', '')
                                    ->where('janitor_id', '')
                                    ->where('sec_guard_id', '')
                                    ->where('sp_id', '')
                                    ->groupBy('emp_id')
                                    ->get()
                                    ->count();

            $cos = $this->body_temp->select('cos_id')
                                   ->whereBetween('date', [$df,$dt])
                                   ->where('status', $status)
                                   ->where('emp_id', '')
                                   ->where('janitor_id', '')
                                   ->where('sec_guard_id', '')
                                   ->where('sp_id', '')
                                   ->groupBy('cos_id')
                                   ->get()
                                   ->count();

            $janitor = $this->body_temp->select('janitor_id')
                                       ->whereBetween('date', [$df,$dt])
                                       ->where('status', $status)
                                       ->where('emp_id', '')
                                       ->where('cos_id', '')
                                       ->where('sec_guard_id', '')
                                       ->where('sp_id', '')
                                       ->groupBy('janitor_id')
                                       ->get()
                                       ->count();

            $sec_guard = $this->body_temp->select('sec_guard_id')
                                         ->whereBetween('date', [$df,$dt])
                                         ->where('status', $status)
                                         ->where('emp_id', '')
                                         ->where('cos_id', '')
                                         ->where('janitor_id', '')
                                         ->where('sp_id', '')
                                         ->groupBy('sec_guard_id')
                                         ->get()
                                         ->count();

            $sp = $this->body_temp->select('sp_id')
                                  ->whereBetween('date', [$df,$dt])
                                  ->where('status', $status)
                                  ->where('emp_id', '')
                                  ->where('cos_id', '')
                                  ->where('janitor_id', '')
                                  ->where('sec_guard_id', '')
                                  ->groupBy('sp_id')
                                  ->get()
                                  ->count();

            return $emp + $cos + $janitor + $sec_guard + $sp;

        }); 

        return $body_temp;

    }




    public function getByDatePersonnel($df, $dt, $id){

        $body_temp = $this->cache->remember('body_temp:getByDatePersonnel:'.$df.'-'.$dt.'-'.$id, 240, function() use ($df, $dt,$id){

          $letter = substr($id, 0, 1);
          
          if ($letter == 'E') {
          
            $body_temp = $this->body_temp->select('emp_id', 'status', 'date')
                                         ->with('empMaster')
                                         ->whereBetween('date', [$df,$dt])
                                         ->where('emp_id', $id)
                                         ->get();

          }elseif($letter == 'C'){
          
            $body_temp = $this->body_temp->select('cos_id', 'status', 'date')
                                         ->with('cosMaster')
                                         ->whereBetween('date', [$df,$dt])
                                         ->where('cos_id', $id)
                                         ->get();

          }elseif($letter == 'J'){
          
            $body_temp = $this->body_temp->select('janitor_id', 'status', 'date')
                                         ->with('janitorMaster')
                                         ->whereBetween('date', [$df,$dt])
                                         ->where('janitor_id', $id)
                                         ->get();

          }elseif($letter == 'S'){
          
            $body_temp = $this->body_temp->select('sec_guard_id', 'status', 'date')
                                         ->with('secGuardMaster')
                                         ->whereBetween('date', [$df,$dt])
                                         ->where('sec_guard_id', $id)
                                         ->get();

          }elseif($letter == 'O'){
          
            $body_temp = $this->body_temp->select('sp_id', 'status', 'date')
                                         ->with('sureccoPersonnel')
                                         ->whereBetween('date', [$df,$dt])
                                         ->where('sp_id', $id)
                                         ->get();

          }

          return $body_temp;

        }); 

        return $body_temp;

    }




    public function getByDate($df, $dt){

        $body_temp = $this->cache->remember('body_temp:getByDate:'.$df.'-'.$dt, 240, function() use ($df, $dt){

            return $this->body_temp->select('emp_id', 'cos_id', 'janitor_id', 'sec_guard_id', 'sp_id', 'cat', 'status', 'date')
                                   ->with('empMaster', 'cosMaster', 'janitorMaster', 'secGuardMaster', 'sureccoPersonnel')
                                   ->whereBetween('date', [$df,$dt])
                                   ->get();

        }); 

        return $body_temp;

    }




    public function getByDateStatus($df, $dt, $status){

        $body_temp = $this->cache->remember('body_temp:getByDateStatus:'.$df.'-'.$dt.':'.$status, 240, function() use ($df, $dt, $status){

            return $this->body_temp->select('emp_id', 'cos_id', 'janitor_id', 'sec_guard_id', 'sp_id', 'cat', 'status', 'date')
                                   ->with('empMaster', 'cosMaster', 'janitorMaster', 'secGuardMaster', 'sureccoPersonnel')
                                   ->where('status', $status)
                                   ->whereBetween('date', [$df,$dt])
                                   ->orderBy('cat', 'asc')
                                   ->get();

        }); 

        return $body_temp;

    }




    public function isExistByCurrentDate($id, $date){

      $date = $this->__dataType->date_parse($date);
      $sub_id = substr($id, 0, 1);
      
      if ($sub_id == 'E') {
          return $this->body_temp->where('emp_id', $id)->whereDate('date', $date)->exists();
      }elseif($sub_id == 'C'){
          return $this->body_temp->where('cos_id', $id)->whereDate('date', $date)->exists();
      }elseif($sub_id == 'J'){
          return $this->body_temp->where('janitor_id', $id)->whereDate('date', $date)->exists();
      }elseif($sub_id == 'S'){
          return $this->body_temp->where('sec_guard_id', $id)->whereDate('date', $date)->exists();
      }elseif($sub_id == 'O'){
          return $this->body_temp->where('sp_id', $id)->whereDate('date', $date)->exists();
      }

      return false;

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