<?php

namespace App\Http\Controllers;


use App\Core\Interfaces\EmpBodyTempInterface;
use App\Http\Requests\EmpBodyTemp\EmpBodyTempFormRequest;
use App\Http\Requests\EmpBodyTemp\EmpBodyTempFilterRequest;


class EmpBodyTempController extends Controller{


    protected $emp_body_temp_repo;


    public function __construct(EmpBodyTempInterface $emp_body_temp_repo){
        $this->emp_body_temp_repo = $emp_body_temp_repo;
    }




    
    // public function index(EmpBodyTempFilterRequest $request){

    //     $emp_body_temps = $this->emp_body_temp_repo->fetch($request);
    //     $request->flash();
    //     return view('dashboard.emp_body_temp.index')->with('emp_body_temps', $emp_body_temps);

    // }

    


    public function create(){
        return view('dashboard.emp_body_temp.create');
    }


   

    // public function store(EmpBodyTempFormRequest $request){

    //     $emp_body_temp = $this->emp_body_temp_repo->store($request);
        
    //     $this->event->fire('emp_body_temp.store');
    //     return redirect()->back();

    // }
 



    // public function edit($slug){

    //     $emp_body_temp = $this->emp_body_temp_repo->findbySlug($slug);
    //     return view('dashboard.emp_body_temp.edit')->with('emp_body_temp', $emp_body_temp);

    // }




    // public function update(EmpBodyTempFormRequest $request, $slug){

    //     $emp_body_temp = $this->emp_body_temp_repo->update($request, $slug);

    //     $this->event->fire('emp_body_temp.update', $emp_body_temp);
    //     return redirect()->route('dashboard.emp_body_temp.index');

    // }

    


    // public function destroy($slug){

    //     $emp_body_temp = $this->emp_body_temp_repo->destroy($slug);
    //     $this->event->fire('emp_body_temp.destroy', $emp_body_temp);
    //     return redirect()->back();

    // }



    
}
