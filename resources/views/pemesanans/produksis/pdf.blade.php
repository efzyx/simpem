<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cetak Daftar Pengiriman</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>
      <h1 class="text-center">Rekapitulasi Produksi</h1>
      <br><br>
          @foreach ($pemesanans as $pemesanan)
          @php
          $i=0;
          $produksis = \App\Models\Produksi::hydrate($pemesanan->produksis);
          $produksis = $produksis->flatten();
          $sisa = $produksis->sum('volume');

          @endphp
          <table>
            <thead>
              <tr>
              <th colspan="3">Data Pemesan</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>Nama Pemesan</strong></td>
                <td>:</td>
                <td>{!! $pemesanan->nama_pemesanan !!}</td>
              </tr>
              <tr>
                <td><strong>Lokasi Proyek</strong></td>
                <td>:</td>
                <td>{!! $pemesanan->lokasi_proyek !!}</td>
              </tr>
              <tr>
                <td><strong>Produk</strong></td>
                <td>:</td>
                <td>{!! $pemesanan->produk->mutu_produk !!}</td>
              </tr>
              <tr>
                <td><strong>Satuan</strong></td>
                <td>:</td>
                <td>{!!$pemesanan->produk->satuan !!}</td>
              </tr>
              <tr>
                <td><strong>Volume Pesanan</strong></td>
                <td>:</td>
                <td>{!! $pemesanan->volume_pesanan !!}</td>
              </tr>
              <tr>
                <td><strong>Realisasi</strong></td>
                <td>:</td>
                <td>{!! $produksis->sum('volume') !!}</td>
              </tr>
              <tr>
                <td>Sisa</td>
                <td>:</td>
                <td>{!! $pemesanan->volume_pesanan - $produksis->sum('volume') !!}</td>
              </tr>
            </tbody>
          </table>
          <br><br>

<table class="table table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal Pengiriman</th>
            <th>No. Polisi</th>
            <th>Volume</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($produksis as $key => $produksi)
          <tr>
            <td>{{$key+1}}</td>
            <td>{{$produksi->produksi_id}}</td>
            <td>{{$kendaraans[$produksi->kendaraan->id]}}</td>
            <td>{{$produksi->volume}}</td>
          </tr>
          @endforeach

          @endforeach
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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



  </body>
</html>
