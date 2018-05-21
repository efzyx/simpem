<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cetak Rekapitulasi Material</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>
      <h1 class="text-center">Rekapitulasi Material</h1>
      <br><br>
      <p>Tanggal : {{$dari ? \Carbon\Carbon::parse($dari)->format('d F Y') : 'Semua Waktu'}} {{ $sampai ? ' - '.\Carbon\Carbon::parse($sampai)->format('d F Y') : ''}}</p>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Nama Material</th>
              <th>Satuan</th>
              <th>Stock</th>
              <th>Masuk</th>
              <th>Keluar</th>
              <th>Jumlah</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($stock as $key => $value)
              @php
                $bb = \App\Models\BahanBaku::find($key);
              @endphp
              <tr>
                <th>{{ $bb->nama_bahan_baku }}</th>
                <td>{{ $bb->satuan }}</td>
                <td>{{ $value['stock'] }}</td>
                <td>{{ $value['masuk'] }}</td>
                <td>{{ $value['keluar'] }}</td>
                <td>{{ $value['masuk'] + $value['keluar'] }}</td>
              </tr>
            @endforeach

          </tbody>
      </table>

      <br><br>

      <div class="pull-right">
           Padang, {{date("d-m-Y")}}
            <br>
           Dibuat Oleh
            <br><br><br><br>
           {{$user}}
      </div>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
</html>
