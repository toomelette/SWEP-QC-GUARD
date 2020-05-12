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
        <h2 class="box-title">Table</h2>
      </div>

      <table class="table table-bordered">
          
        <thead>
          <td>Status</td>
          <td>Temperature</td>
        </thead>

        <tbody>

          <tr>
            <td>Below Normal</td>
            <td>36.0°C Down</td>
          </tr>

          <tr>
            <td>Normal</td>
            <td>36.0°C - 37.2°C</td>
          </tr>

          <tr>
            <td>Above Normal</td>
            <td>37.3°C - 37.9°C</td>
          </tr>

          <tr>
            <td>Fever</td>
            <td>38.0°C Up</td>
          </tr>
          
        </tbody>

      </table>

    </div>
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Edit Personnel Body Temperature</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
            &nbsp;
            {!! __html::back_button(['dashboard.body_temp.index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.body_temp.update', $body_temp->slug) }}">

        <div class="box-body">

            <input name="_method" value="PUT" type="hidden">
            
            @csrf     
            
            {!! __form::select_static(
              '4', 'id', 'Personnel *', old('id') ? old('id') : $body_temp->origin_id, $personnel_list, $errors->has('id'), $errors->first('id'), 'select2', ''
            ) !!}

            {!! __form::select_static(
              '4', 'status', 'Body Temperature *', old('status') ? old('status') : $body_temp->status, ['Below Normal' => '1', 'Normal' => '2', 'Above Normal' => '3', 'Fever' => '4'], $errors->has('status'), $errors->first('status'), '', ''
            ) !!}

        </div>


        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

</section>

@endsection