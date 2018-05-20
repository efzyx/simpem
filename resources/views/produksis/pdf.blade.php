<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cetak Daftar Produksi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>
      <h1 class="text-center">Produksi</h1>
      <br><br>
      @php
      $tmutu = [];
      $bahan = \App\Models\BahanBaku::select('id','nama_bahan_baku','satuan')->get();
      $b = count($bahan);

      @endphp
      <table class="table table-bordered">
        <thead>
          <tr>
            <th  rowspan="2">No</th>
            <th rowspan="2">Tanggal Produksi</th>
            <th rowspan="2">Mutu Produk</th>
            <th rowspan="2">Volume</th>
            <th colspan="{{$b}}" align="text-center">Material</th>
          </tr>
          <tr>
            @foreach($bahan as $key => $bhn)
            <th>{{$bhn->nama_bahan_baku}}</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
          @php
          $h = 0;
          while($h<$b){
            $tmutu[$h] = 0;
            $h++;
          }
          @endphp
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
              @php
              while($i<$b){
                echo "<td>0</td>";
                  if ($tmutu[$i]>=0) {
                      $tmutu[$i] += 0;
                  }
                  $i++;
              }
              @endphp
            </tr>
          @endforeach
          <tfoot>
            <tr>
              <td colspan="3">Total</td>
              <td>{{ $produksis->sum('volume')}}</td>
              @php
              $a = 0;
              while($a < $b){
                echo "<td>$tmutu[$a]</td>";
                $a++;
              }
              @endphp
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
