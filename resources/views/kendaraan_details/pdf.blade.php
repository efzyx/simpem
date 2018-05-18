<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cetak Status Kendaraan <strong>{{$kendaraan->jenis_kendaraan}} ({{$kendaraan->no_polisi}})</strong></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>
      <h1 class="text-center">Cetak Status Kendaraan {{$kendaraan->jenis_kendaraan}} ({{$kendaraan->no_polisi}})</h1>
      @php
      $days = [0,0,0,0];
      $first = true;
      @endphp
      <br><br>


        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Status Kendaran</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          @foreach ($details as $key => $detail)

          <tbody>
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$detail->waktu}}</td>
                <td>{{$status[$detail->status]}}</td>
                <td>{{$detail->keterangan}}</td>
              </tr>

              @php
              $date1;

              if($first == true){
                $date1 = $detail->waktu;
                $first = false;
              }
              else{
                $difference = date_diff($date1,$detail->waktu);
                $days[$detail->status] = $days[$detail->status] + $difference->d;
                $date1 = $detail->waktu;
              }
              @endphp
        @endforeach



          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        </tbody>
      </table>
      <div class="pull-left">
        <table>
          <tr>
            <td>Jumlah Hari Stand By </td>
            <td> : </td>
            <td>{{$days[1]}}</td>
          </tr>
          <tr>
            <td>Jumlah Hari Rusak </td>
            <td> : </td>
            <td>{{$days[2]}}</td>
          </tr>
          <tr>
            <td>Jumlah Hari Rental </td>
            <td> : </td>
            <td>{{$days[3]}}</td>
          </tr>
        </table>
      </div>

      <br><br>
      <br><br>
      <div class="pull-right">
           Padang, {{date("d-m-Y")}}
            <br>
           Dibuat Oleh
            <br><br><br><br>
           {{$user}}
      </div>

  </body>
</html>
