<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cetak Daftar Pemesanan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>
      <h1 class="text-center">Pemesanan</h1>
      <br><br>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Pemesanan</th>
            <th>Mutu Produk</th>
            <th>Tanggal Pesanan</th>
            <th>Lokasi Proyek</th>
            <th>Jenis Pemesanan</th>
            <th>CP Pemesanan</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        @php
          $jenis = ['Retail', 'Non Retail'];
        @endphp
        <tbody>
          @foreach ($pemesanans as $key => $pemesanan)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$pemesanan->nama_pemesanan}}</td>
              <td>{{$pemesanan->produk->mutu_produk}}</td>
              <td>{{$pemesanan->tanggal_pesanan->format('d M Y')}}</td>
              <td>{{$pemesanan->lokasi_proyek}}</td>
              <td>{{$jenis[$pemesanan->jenis_pesanan]}}</td>
              <td>{{$pemesanan->cp_pesanan}}</td>
              <td>{{$pemesanan->keterangan}}</td>
            </tr>
          @endforeach

          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        </tbody>
      </table>

  </body>
</html>
