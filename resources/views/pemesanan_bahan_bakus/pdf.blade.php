<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cetak Daftar Pemesanan Material</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>
      <h1 class="text-center">Pemesanan Material</h1>
      <br><br>
      <table class="table table-bordered">
          <thead>
              <tr>
              <th>No</th>
              <th>Nama Supplier</th>
              <th>CP Supplier</th>
              <th>Material</th>
              <th>Volume</th>
              <th>Diterima</th>
              <th>Sisa</th>
              <th>Tanggal</th>
              <th>Keterangan</th>
              </tr>
          </thead>
          <tbody>
            @php
              $no = 1;
            @endphp
          @foreach($pemesananBahanBakus as $pemesananBahanBaku)
              <tr>
                @php
                  $satuan = $pemesananBahanBaku->bahan_baku->satuan;
                @endphp
                  <td>{!! $no++ !!}</td>
                  <td>{!! $pemesananBahanBaku->nama_supplier !!}</td>
                  <td>{!! $pemesananBahanBaku->cp_supplier !!}</td>
                  <td>{!! $pemesananBahanBaku->bahan_baku->nama_bahan_baku !!}</td>
                  <td>{!! $volume = $pemesananBahanBaku->volume_pemesanan !!} {!! $satuan !!}</td>
                  <td>{!! $terima = $pemesananBahanBaku->pengadaans->sum('berat') !!} {!! $satuan !!}</td>
                  <td>{!! $volume-$terima !!} {!! $satuan !!}</td>
                  <td>{!! $pemesananBahanBaku->tanggal_pemesanan->format('d-m-Y') !!}</td>
                  <td>{!! $pemesananBahanBaku->keterangan !!}</td>
              </tr>
          @endforeach
          </tbody>
      </table>



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
