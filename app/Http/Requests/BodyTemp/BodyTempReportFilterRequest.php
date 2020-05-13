<?php

namespace App\Http\Requests\BodyTemp;

use Illuminate\Foundation\Http\FormRequest;

class BodyTempReportFilterRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            'type' => 'required|string|max:11', 
            'df' => 'sometimes|required|date_format:"m/d/Y"',
            'dt' => 'sometimes|required|date_format:"m/d/Y"', 
            'p_id' => 'sometimes|required|string|max:11',

        ];

    }







}
