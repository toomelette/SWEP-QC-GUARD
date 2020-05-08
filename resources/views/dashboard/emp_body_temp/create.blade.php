@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Add Employee Body Temperature</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.emp_body_temp.store') }}">

        <div class="box-body">
          <div class="col-md-12">
                  
            @csrf    

            {!! __form::select_dynamic(
              '4', 'emp_id', 'Employees', old('emp_id'), $global_employees_all, 'emp_id', 'fullname', $errors->has('emp_id'), $errors->first('emp_id'), 'select2', ''
            ) !!}

            {!! __form::select_static(
              '4', 'status', 'Body Temperature *', old('status'), ['Below Normal' => '1', 'Normal' => '2', 'Above Normal' => '3'], $errors->has('status'), $errors->first('status'), '', ''
            ) !!}

          </div>
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

    @if(Session::has('EMP_BODY_TEMP_CREATE_SUCCESS'))
      {!! __js::toast(Session::get('EMP_BODY_TEMP_CREATE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection