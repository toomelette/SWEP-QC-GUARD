<!DOCTYPE html>
<html>
<head>
	<title>Personnel Body Temperature</title>
	<link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">
	<link rel="stylesheet" href="{{ asset('template/dist/css/skins/_all-skins.min.css') }}">

  <style type="text/css">
      
      th{
        text-align: center;
      }
      
      td{
        text-align: center;
      }

  </style>

</head>
<body onload="window.print();" onafterprint="window.close()">

	<section class="invoice" style="page-break-after:always">


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
          <span>Personnel Body Temperature Report</span><br>
          <span>As of {{ __dataType::date_scope(Request::get('df'), Request::get('dt')) }}</span>
        </div>
      </div>
      <div class="col-xs-1"></div>
    </div>


    {{-- TABLE --}}
    <div class="row" style="padding-top:20px;">
      <div class="col-xs-12 table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Status</th>
              <th>MONDAY</th>
              <th>TUESDAY</th>
              <th>WEDNESDAY</th>
              <th>THURSDAY</th>
              <th>FRIDAY</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Below Normal</td>
              <td>{{ $list[0][1] }}</td>
              <td>{{ $list[1][1] }}</td>
              <td>{{ $list[2][1] }}</td>
              <td>{{ $list[3][1] }}</td>
              <td>{{ $list[4][1] }}</td>
            </tr>
            <tr>
              <td>Normal</td>
              <td>{{ $list[0][2] }}</td>
              <td>{{ $list[1][2] }}</td>
              <td>{{ $list[2][2] }}</td>
              <td>{{ $list[3][2] }}</td>
              <td>{{ $list[4][2] }}</td>
            </tr>
            </tr>
            <tr>
              <td>Above Normal</td>
              <td>{{ $list[0][3] }}</td>
              <td>{{ $list[1][3] }}</td>
              <td>{{ $list[2][3] }}</td>
              <td>{{ $list[3][3] }}</td>
              <td>{{ $list[4][3] }}</td>
            </tr>
            <tr>
              <td>Fever</td>
              <td>{{ $list[0][4] }}</td>
              <td>{{ $list[1][4] }}</td>
              <td>{{ $list[2][4] }}</td>
              <td>{{ $list[3][4] }}</td>
              <td>{{ $list[4][4] }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>


    {{-- PREPARED BY --}}
    <div class="row" style="padding-top:30px;">
      <div class="col-xs-2">
        &nbsp;
      </div>
      <div class="col-xs-3">
        &nbsp;
      </div>
      <div class="col-xs-1">
        &nbsp;
      </div>
      <div class="col-xs-2">
        &nbsp;
      </div>
      <div class="col-xs-4">
        <span style="font-size:15px;">Prepared By:</span>
      </div>
    </div>


    <div class="row" style="padding-top:50px;">
      <div class="col-xs-2">
        &nbsp;
      </div>
      <div class="col-xs-3">
        &nbsp;
      </div>
      <div class="col-xs-1">
        &nbsp;
      </div>
      <div class="col-xs-2">
        &nbsp;
      </div>
      <div class="col-xs-4">
        <span style="font-size:15px;">BERTRAM JAY S. LANGRUTO</span><br>
        <span style="font-size:15px;">Web Developer</span>
      </div>
    </div>

  </section>



  {{-- Next Page --}}
  <section>

    <div class="row">

      <div class="col-xs-12 table-responsive">
        <h3>Above Normal</h3>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Fullname</th>
              <th>Category</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            @php
              $an = 0;
            @endphp
            @foreach ($above_normal_list as $data)
              <tr>
                <td>{{ $an += 1 }}</td>
                <td>{{ $data->fullname }}</td>
                <td>{{ $data->displayCategoryText() }}</td>
                <td>{{ __dataType::date_parse($data->date, 'F d, Y') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>

      </div>



      <div class="col-xs-12 table-responsive">
        <h3>Fever</h3>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Fullname</th>
              <th>Category</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            @php
              $f = 0;
            @endphp
            @foreach ($fever_list as $data)
              <tr>
                <td>{{ $f += 1 }}</td>
                <td>{{ $data->fullname }}</td>
                <td>{{ $data->displayCategoryText() }}</td>
                <td>{{ __dataType::date_parse($data->date, 'F d, Y') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>

      </div>


    </div>

  </section>


</body>
</html>