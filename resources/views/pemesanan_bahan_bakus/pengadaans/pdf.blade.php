<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cetak Daftar Pemesanan Material</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>
      <h1 class="text-center">Penerimaan Material</h1>
      <br><br>
          @foreach ($suppliers as $supplier)
          @php
          $i=0;
          $pengadaans = \App\Models\Pengadaan::hydrate($supplier->pengadaans);
          $pengadaans = $pengadaans->flatten();
          $sisa = $pengadaans->sum('berat');

          @endphp
          <table>
            <thead>
              <tr>
              <th colspan="3">Data Supplier</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>Nama Supplier</strong></td>
                <td>:</td>
                <td>{!! $supplier->nama_supplier !!}</td>
              </tr>
              <tr>
                <td><strong>Nama Material</strong></td>
                <td>:</td>
                <td>{!! $bahan_baku[$supplier->bahan_baku_id] !!}</td>
              </tr>
              <tr>
                <td><strong>Total Pesanan</strong></td>
                <td>:</td>
                <td>{!! $supplier->volume_pemesanan !!}</td>
              </tr>
              <tr>
                <td><strong>Sisa Pesanan</strong></td>
                <td>:</td>
                <td>{!! $supplier->volume_pemesanan - $sisa !!}</td>
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
            <th>Satuan</th>
            <th>Volume</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($pengadaans as $key => $pengadaan)
          <tr>
            <td>{{$key+1}}</td>
            <td>{{$pengadaan->tanggal_pengadaan}}</td>
            <td>{{$pengadaan->supir}}</td>
            <td>{{$pengadaan->bahan_baku->satuan}}</td>
            <td>{{$pengadaan->berat}}</td>
          </tr>
          @endforeach

          @endforeach
          <tfoot>
            <tr>
              <td colspan="4"><strong>Total</strong></td>
              <td><strong>{{$sisa}}</strong></td>
            </tr>
          </tfoot>
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
