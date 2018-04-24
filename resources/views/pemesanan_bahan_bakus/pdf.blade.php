<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cetak Daftar Penerimaan Bahan Baku</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>
      <h1 class="text-center">Penerimaan Bahan Baku</h1>
      <br><br>
      <table class="table table-bordered">
          <thead>
              <tr>
              <th>No</th>
              <th>Nama Supplier</th>
              <th>Cp Supplier</th>
              <th>Bahan Baku</th>
              <th>Volume Pemesanan</th>
              <th>Tanggal Pemesanan</th>
              <th>Keterangan</th>
              </tr>
          </thead>
          <tbody>
            @php
              $no = 1;
            @endphp
          @foreach($pemesananBahanBakus as $pemesananBahanBaku)
              <tr>
                  <td>{!! $no++ !!}</td>
                  <td>{!! $pemesananBahanBaku->nama_supplier !!}</td>
                  <td>{!! $pemesananBahanBaku->cp_supplier !!}</td>
                  <td>{!! $bahan_baku[$pemesananBahanBaku->bahan_baku_id] !!}</td>
                  <td>{!! $pemesananBahanBaku->volume_pemesanan !!}</td>
                  <td>{!! $pemesananBahanBaku->tanggal_pemesanan !!}</td>
                  <td>{!! $pemesananBahanBaku->keterangan !!}</td>
              </tr>
          @endforeach
          </tbody>
      </table>



          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        </tbody>
      </table>

  </body>
</html>
