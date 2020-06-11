<?php

namespace App\Http\Controllers;


use App\Core\Interfaces\BodyTempInterface;
use App\Http\Requests\BodyTemp\BodyTempFormRequest;
use App\Http\Requests\BodyTemp\BodyTempFilterRequest;
use App\Http\Requests\BodyTemp\BodyTempReportFilterRequest;


class BodyTempController extends Controller{


    protected $body_temp_repo;


    public function __construct(BodyTempInterface $body_temp_repo){
        $this->body_temp_repo = $body_temp_repo;
        parent::__construct();
    }




    public function index(BodyTempFilterRequest $request){

        $body_temp_list = $this->body_temp_repo->fetch($request);
        $request->flash();
        return view('dashboard.body_temp.index')->with('body_temp_list', $body_temp_list);

    }

    

    public function create(){
        return view('dashboard.body_temp.create');
    }


   
    public function store(BodyTempFormRequest $request){

        dd($this->body_temp_repo->isExistByCurrentDate($request->id, $request->date));

        if ($this->body_temp_repo->isExistByCurrentDate($request->id, $request->date)) {
                
            $this->session->flash("BODY_TEMP_IS_EXIST","The Personnel is already added in today's Record.");
            $request->flash();
            return redirect()->back();
            
        }

        $body_temp = $this->body_temp_repo->store($request);
        $this->event->fire('body_temp.store');
        return redirect()->back();

    }
 


    public function edit($slug){

        $body_temp = $this->body_temp_repo->findbySlug($slug);
        return view('dashboard.body_temp.edit')->with('body_temp', $body_temp);

    }



    public function update(BodyTempFormRequest $request, $slug){

        $body_temp = $this->body_temp_repo->update($request, $slug);

        $this->event->fire('body_temp.update', $body_temp);
        return redirect()->route('dashboard.body_temp.index');

    }

    

    public function destroy($slug){

        $body_temp = $this->body_temp_repo->destroy($slug);
        $this->event->fire('body_temp.destroy', $body_temp);
        return redirect()->back();

    }

    

    public function reports(){
        return view('dashboard.body_temp.reports');
    }

    

    public function reportPrint(BodyTempReportFilterRequest $request){

        $df = $this->__dataType->date_parse($request->df, 'Y-m-d');
        $dt = $this->__dataType->date_parse($request->dt, 'Y-m-d');

        if ($request->type == 'cbd') {

            $list = [];

            $days = $this->__dynamic->days_between_dates($request->df, $request->dt, 'Y-m-d');

            for ($i=0; $i <= 4; $i++) { 
                for ($j=1; $j <= 4; $j++) { 
                    $list[$i][$j] = $this->body_temp_repo->countByDateStatus($days[$i], $days[$i], $j);
                }
            }

            return view('printables.body_temp.count_by_date')->with('list', $list); 

        }elseif ($request->type == 'lopbd') {
            
            $body_temp_list = $this->body_temp_repo->getByDate($df, $dt);
            return view('printables.body_temp.list_of_personnel_by_date')->with('body_temp_list', $body_temp_list); 

        }

        
    }



}
