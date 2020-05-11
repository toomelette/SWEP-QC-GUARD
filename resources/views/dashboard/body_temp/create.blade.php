<?php
  
  $employee_list = $global_employees_all->pluck('emp_id', 'fullname')->toArray();
  $cos_list = $global_cos_all->pluck('cos_id', 'fullname')->toArray();

  $personnel_list = array_merge($employee_list, $cos_list);

?>

@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Add Personnel Body Temperature</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.body_temp.store') }}">

        <div class="box-body">
                  
          @csrf    
          
          {!! __form::select_static(
            '4', 'id', 'Personnel *', old('id'), $personnel_list, $errors->has('id'), $errors->first('id'), 'select2', ''
          ) !!}

          {!! __form::select_static(
            '4', 'status', 'Body Temperature *', old('status'), ['Below Normal' => '1', 'Normal' => '2', 'Above Normal' => '3'], $errors->has('status'), $errors->first('status'), '', ''
          ) !!}

        </div>


        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

</section>

@endsection




@section('scripts')

  <script type="text/javascript">

    @if(Session::has('BODY_TEMP_CREATE_SUCCESS'))
      {!! __js::toast(Session::get('BODY_TEMP_CREATE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection