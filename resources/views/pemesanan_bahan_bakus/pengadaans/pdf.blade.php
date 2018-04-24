<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cetak Daftar Penerimaan Bahan Baku</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>
      <h1 class="text-center">Rekapitulasi Penerimaan Bahan Baku</h1>
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
            <td><strong>Nama Bahan Baku</strong></td>
            <td>:</td>
            <td>{!! $supplier->bahan_baku->nama_bahan_baku !!}</td>
          </tr>
          <tr>
            <td><strong>Total Pesanan</strong></td>
            <td>:</td>
            <td>{!! $supplier->volume_pemesanan !!}</td>
          </tr>
          <tr>
            <td><strong>Sisa Pesanan</strong></td>
            <td>:</td>
            <td>{!! $supplier->volume_pemesanan-$pengadaans->sum('berat') !!}</td>
          </tr>
        </tbody>
      </table>
      <br><br>

      <table class="table table-bordered">
          <thead>
              <tr>
              <th>#</th>
              <th>Tanggal Penerimaan</th>
              <th>No Polisi</th>
              <th>Satuan</th>
              <th>Volume</th>
              </tr>
          </thead>
          <tbody>
            @php
            $no = 1;
            @endphp
          @foreach($pengadaans as $pengadaan)
              <tr>
                  <td>{{ $no++ }}</td>
                  <td>{!! $pengadaan->tanggal_pengadaan !!}</td>
                  <td>{!! $pengadaan->supir !!}</td>
                  <td>{!! $pengadaan->bahan_baku->satuan !!}</td>
                  <td>{!! $pengadaan->berat !!}</td>


              </tr>
          @endforeach
          <tfoot>
            <tr>
              <td colspan="4"><strong>Total</strong></td>
              <td>{!! $pengadaans->sum('berat') !!}</td>
            </tr>
          </tfoot>
          </tbody>
      </table>
      @endforeach


          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        </tbody>
      </table>

  </body>
</html>
