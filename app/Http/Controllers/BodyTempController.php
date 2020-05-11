<?php

namespace App\Http\Controllers;


use App\Core\Interfaces\BodyTempInterface;
use App\Http\Requests\BodyTemp\BodyTempFormRequest;
use App\Http\Requests\BodyTemp\BodyTempFilterRequest;


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



}
