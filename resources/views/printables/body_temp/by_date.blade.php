<!DOCTYPE html>
<html>
<head>
	<title>Purchase Order</title>
	<link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">
	<link rel="stylesheet" href="{{ asset('template/dist/css/skins/_all-skins.min.css') }}">
</head>
<body onload="window.print();" onafterprint="window.close()">

	<section class="invoice">

    {{-- <div class="row" style="padding-top:10px;">
      <div class="col-xs-12">
        <h2 class="page-header">
          <img src="{{ asset('images/logo.png') }}" style="width:200px; height:70px; margin-top: -20px"> 
          <span class="pull-right" style="font-size:30px;">Delivery Report</span>
        </h2>
      </div>
    </div>

    <div class="row invoice-info">

      <div class="col-sm-4 invoice-col">
        <b>Delivery Code:</b> {{ $delivery->delivery_code }}<br>
        <b>Date:</b> {{ __dataType::date_parse($delivery->date, 'm/d/Y') }}<br>
        <b>Description: </b>{!! $delivery->description !!}<br>
      </div>

    </div> --}}



    <div class="row" style="padding-top:10px;">
      <div class="col-xs-12 table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="text-align: center;">Status</th>
              <th style="text-align: center;">MONDAY</th>
              <th style="text-align: center;">TUESDAY</th>
              <th style="text-align: center;">WEDNESDAY</th>
              <th style="text-align: center;">THURSDAY</th>
              <th style="text-align: center;">FRIDAY</th>
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

  </section>

</body>
</html>