<!DOCTYPE html>
<html>
<head>
	<title>Personnel Body Temperature</title>
	<link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">
	<link rel="stylesheet" href="{{ asset('template/dist/css/skins/_all-skins.min.css') }}">

</head>
<body onload="window.print();" onafterprint="window.close()">

	<section class="invoice">

    {{-- HEADER --}}
    <div class="row" style="padding:10px;">
      
      <div class="col-xs-1"></div>

      <div class="col-xs-12">

        <div class="col-xs-1"></div>

        <div class="col-xs-3">
          <img src="{{ asset('favicon.ico') }}" style="width:120px;">
        </div>

        <div class="col-xs-8" style="text-align: center; padding-right:125px;">
          <span>Republic of the Philippines</span><br>
          <span style="font-size:15px; font-weight:bold;">SUGAR REGULATORY ADMINISTRATION</span><br>
          <span>North Avenue, Diliman, Quezon City</span><br>
          <span>List of Personnel Body Temperature by Date</span><br>
          <span>As of {{ __dataType::date_scope(Request::get('df'), Request::get('dt')) }}</span>
        </div>

      </div>

      <div class="col-xs-1"></div>

    </div>


    <div class="row" style="padding-top:20px;">
      <div class="col-xs-12 table-responsive">

        <table class="table table-bordered">

          <thead>
            <tr>
              <th>Personnel</th>
              <th>Category</th>
              <th>Status</th>
              <th>Date</th>
            </tr>
          </thead>


          <tbody>

            @php
              $days = __dynamic::days_between_dates(Request::get('df'), Request::get('dt'), 'm/d/Y');
            @endphp

            @foreach ($days as $data_days)
              @foreach ($body_temp_list->sortBy('fullname') as $data)
                @if ($data_days == $data->date->format('m/d/Y'))
                  <tr>
                    <td>{{ $data->fullname }}</td>
                    <td>{{ $data->displayCategoryText() }}</td>
                    <td>{!! $data->displayStatusText() !!}</td>
                    <td>{{ $data->date->format('F d, Y') }}</td>
                  </tr>
                @endif
              @endforeach
            @endforeach

          </tbody>

        </table>

      </div>
    </div>

  </section>

</body>
</html>