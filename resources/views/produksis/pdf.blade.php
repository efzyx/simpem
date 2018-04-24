<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cetak Daftar Produksi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>
      <h1 class="text-center">Pemesanan</h1>
      <br><br>
      <?php $tmutu = [0,0,0,0,0]; ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th  rowspan="2">No</th>
            <th rowspan="2">Tanggal Produksi</th>
            <th rowspan="2">Mutu Produk</th>
            <th rowspan="2">Volume</th>
            <th colspan="5" align="text-center">Material</th>
          </tr>
          <tr>
            <th>Semen</th>
            <th>Air</th>
            <th>Pasir</th>
            <th>Split</th>
            <th>Addictive</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($produksis as $key => $produksi)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$produksi->waktu_produksi}}</td>
              @php
                $mutu = $produksi->pemesanan->produk;
              @endphp
              <td>{{$mutu->mutu_produk}}</td>
              <td>{{$produksi->volume}}</td>
            @php
             $komposisi_mutu = $produksi->pemesanan->produk->komposisi_mutus;
             $i = 0;
            @endphp
              @foreach ($komposisi_mutu as $key => $komposisi)
                <td>{!! $komposisi->volume * $produksi->volume!!}</td>
                @php
                  if ($tmutu[$i]<=0) {
                    $tmutu[$i] = $komposisi->volume * $produksi->volume;
                  }else{
                      $tmutu[$i] += $komposisi->volume * $produksi->volume;
                  }
                  $i++;
                @endphp
              @endforeach
            </tr>
          @endforeach
          <tfoot>
            <tr>
              <td colspan="3">Total</td>
              <td>{{ $produksis->sum('volume')}}</td>
              <td>{!! $tmutu[0] !!}</td>
              <td>{!! $tmutu[1] !!}</td>
              <td>{!! $tmutu[2] !!}</td>
              <td>{!! $tmutu[3] !!}</td>
              <td>{!! $tmutu[4] !!}</td>
            </tr>
          </tfoot>


          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        </tbody>
      </table>

  </body>
</html>
