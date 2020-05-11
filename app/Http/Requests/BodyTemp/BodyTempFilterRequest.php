<?php

namespace App\Http\Requests\BodyTemp;

use Illuminate\Foundation\Http\FormRequest;

class BodyTempFilterRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            'q'=>'nullable|string|max:90',

        ];

    }







}
