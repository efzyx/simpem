<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Rekapitulasi Kendaraan</title>
    {{-- <link rel="stylesheet" href={{ asset('css/bootstrap.min.css') }}> --}}
  </head>
  <body>
      <strong>Rekapitulasi Status Kendaraan</strong>
      <br><br>

      <div class="pull-left">
        <table>
          <tr>
            <th>No Polisi </th>
            <th> : </th>
            <td>{{$kendaraan->no_polisi}}</td>
          </tr>
          <tr>
            <th>Jenis Kendaraan </th>
            <th> : </th>
            <td>{{$kendaraan->jenis_kendaraan}}</td>
          </tr>
          <tr>
            <th>Masa Berlaku Pajak </th>
            <th> : </th>
            <td>{{$kendaraan->masa_pajak->format('d F Y')}}</td>
          </tr>
          <tr>
            <th>Masa Berlaku STNK </th>
            <th> : </th>
            <td>{{$kendaraan->masa_stnk->format('d F Y')}}</td>
          </tr>
        </table>
      </div>
      <div class="pull-right">
        <table>
          <tr>
            <th>Masa Berlaku KIR </th>
            <th> : </th>
            <td>{{$kendaraan->masa_kir->format('d F Y')}}</td>
          </tr>
          <tr>
            <th>Jumlah Hari StandBy </th>
            <th> : </th>
            <td>{{$standby}}</td>
          </tr>
          <tr>
            <th>Jumlah Hari Rusak </th>
            <th> : </th>
            <td>{{$rusak}}</td>
          </tr>
          <tr>
            <th>Jumlah Hari Rental </th>
            <th> : </th>
            <td>{{$rental}}</td>
          </tr>
        </table>
      </div>
      <div class="clearfix">

      </div>
      <br>
        <table>
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
        @endforeach

        </tbody>
      </table>
      <br><br>

              {{-- <script src="{{ asset('js/jquery.min.js') }}"></script>
              <script src="{{ asset('js/bootstrap.min.js') }}"></script> --}}

  </body>
</html>
