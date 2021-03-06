<?php

  $table_sessions = [ Session::get('BODY_TEMP_UPDATE_SUCCESS_SLUG') ];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'direction' => Request::get('direction'),
                        
                        'df' => Request::get('df'),
                        'dt' => Request::get('dt'),
                      ];

?>


@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Personnel Body Temperature</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.body_temp.index') }}">


    {{-- Advance Filters --}}
    {!! __html::filter_open() !!}

      <div class="col-md-12 no-padding">
        
        <h5>Date Filter : </h5>

        {!! __form::datepicker('3', 'df',  'From', old('df'), '', '') !!}

        {!! __form::datepicker('3', 'dt',  'To', old('dt'), '', '') !!}

        <button type="submit" class="btn btn-primary" style="margin:25px;">Filter Date <i class="fa fa-fw fa-arrow-circle-right"></i></button>

      </div>

    {!! __html::filter_close('submit_dv_filter') !!}


    <div class="box box-solid" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.body_temp.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th>@sortablelink('empMaster.lastname', 'Employee')</th>
            <th>@sortablelink('status', 'Status')</th>
            <th>@sortablelink('date', 'Date')</th>
            <th>@sortablelink('date', 'Timestamp')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($body_temp_list as $data) 
            <tr {!! __html::table_highlighter($data->slug, $table_sessions) !!} >
              <td id="mid-vert">{{ $data->fullname }}</td>
              <td id="mid-vert">{!! $data->displayStatusSpan() !!}</td>
              <td id="mid-vert">{!! $data->date->format('F d, Y') !!}</td>
              <td id="mid-vert">{!! $data->created_at->format('F d, Y h:i A') !!}</td>
              <td id="mid-vert">
                <div class="btn-group">
                  <a type="button" class="btn btn-default" id="edit_button" href="{{ route('dashboard.body_temp.edit', $data->slug) }}">
                    <i class="fa fa-pencil"></i>
                  </a>
                  <a type="button" class="btn btn-default" id="delete_button" data-action="delete" data-url="{{ route('dashboard.body_temp.destroy', $data->slug) }}">
                    <i class="fa fa-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
            @endforeach
          </table>
      </div>

      @if($body_temp_list->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($body_temp_list) !!}
        {!! $body_temp_list->appends($appended_requests)->render('vendor.pagination.bootstrap-4')!!}
      </div>

    </div>

  </section>

@endsection



@section('modals')

  {!! __html::modal_delete('body_temp_delete') !!}

@endsection 



@section('scripts')

  <script type="text/javascript">

    {!! __js::button_modal_confirm_delete_caller('body_temp_delete') !!}

    @if(Session::has('BODY_TEMP_UPDATE_SUCCESS'))
      {!! __js::toast(Session::get('BODY_TEMP_UPDATE_SUCCESS')) !!}
    @endif

    @if(Session::has('BODY_TEMP_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('BODY_TEMP_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection