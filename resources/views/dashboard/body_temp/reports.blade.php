<?php
  
  $employee_list = $global_employees_all->pluck('emp_id', 'fullname')->toArray();
  $cos_list = $global_cos_all->pluck('cos_id', 'fullname')->toArray();
  $janitor_list = $global_janitor_all->pluck('janitor_id', 'fullname')->toArray();
  $sec_guard_list = $global_sec_guard_all->pluck('sec_guard_id', 'fullname')->toArray();

  $personnel_list = array_merge($employee_list, $cos_list, $janitor_list, $sec_guard_list);

  $categories = ['Regular Employees' => '1', 'Regular Employees' => '1']

?>

@extends('layouts.admin-master')

@section('content')

<section class="content">
            

    {{-- By Date --}}
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">By Date</h2>
      </div>
      
      <form method="GET" autocomplete="off" action="{{ route('dashboard.body_temp.report_print') }}" target="_blank">

        <div class="box-body">    

          <input type="hidden" name="type" value="bd">

          {!! __form::datepicker(
            '3', 'df',  'From *', old('df'), $errors->has('df'), $errors->first('df')
          ) !!}

          {!! __form::datepicker(
            '3', 'dt',  'To *', old('dt'), $errors->has('dt'), $errors->first('dt')
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Print <i class="fa fa-fw fa-print"></i></button>
        </div>

      </form>

    </div>


            
    {{-- By Personnel --}}
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">By Personnel</h2>
      </div>
      
      <form method="GET" autocomplete="off" action="{{ route('dashboard.body_temp.report_print') }}" target="_blank">

        <div class="box-body">    

          <input type="hidden" name="type" value="bp">
          
          {!! __form::select_static(
            '4', 'p_id', 'Personnel *', old('p_id'), $personnel_list, $errors->has('p_id'), $errors->first('p_id'), 'select2', ''
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Print <i class="fa fa-fw fa-print"></i></button>
        </div>

      </form>

    </div>


</section>

@endsection