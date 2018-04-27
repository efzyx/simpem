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

        @foreach ($pemesanans as $pemesanan)
        @php
        $produksis = $pemesanan->produksis;
        @endphp
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Pemesan</th>
              <th>Mutu</th>
              <th>Lokasi Proyek</th>
              <th>Volume Pesanan</th>
              <th>Tanggal Pengiriman</th>
              <th>No Polisi</th>
              <th>Volume</th>
              <th>Realisasi</th>
              <th>Sisa Pesanan</th>
            </tr>
          </thead>
          @php
            $jenis = ['Retail', 'Non Retail'];
            $prod = count($produksis);
            $first = true;
          @endphp
          <tbody>
            @foreach ($produksis as $key => $produksi)
              <tr>
               @if ($first == true)
                <td rowspan="{{$prod}}">{{$key+1}}</td>
                <td rowspan="{{$prod}}">{{$pemesanan->nama_pemesanan}}</td>
                <td rowspan="{{$prod}}">{{$pemesanan->produk->mutu_produk}}</td>
                <td rowspan="{{$prod}}">{{$pemesanan->lokasi_proyek}}</td>
                <td rowspan="{{$prod}}">{{$pemesanan->volume_pesanan}}</td>
                @endif
                <td>{{$produksi->waktu_produksi}}</td>
                <td>{{$kendaraans[$produksi->kendaraan->id]}}</td>
                <td>{{$produksi->volume}}</td>
                @if($first==true)
                <td rowspan="{{$prod}}">{{$pemesanan->produksis->sum('volume')}}</td>
                <td rowspan="{{$prod}}">{{$pemesanan->volume_pesanan - $pemesanan->produksis->sum('volume')}}</td>
                @endif
                @php $first = false; @endphp
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
