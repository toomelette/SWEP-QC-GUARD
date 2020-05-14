<?php

namespace App\Http\Requests\BodyTemp;

use Illuminate\Foundation\Http\FormRequest;

class BodyTempFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            'id'=>'required|string|max:11',
            'status'=>'required|string|max:1',
            'date' => 'required|date_format:"m/d/Y"',

        ];

    }







}
