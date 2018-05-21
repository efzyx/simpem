<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cetak Daftar Pengiriman</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>
      <h1 class="text-center">BPO Sheet</h1>
      <br><br>
          @foreach ($pemesanans as $pemesanan)
          @php
          $i=0;
          $produksis = \App\Models\Produksi::hydrate($pemesanan->produksis);
          $produksis = $produksis->flatten();
          $sisa = $produksis->sum('volume');

          @endphp
          <div class="pull-left">
            <table>
              <tbody>
                <tr>
                  <td style="border : none"><strong>No. Dokumen  </strong></td>
                  <td style="border : none">: {!! $pemesanan->nomor_dokumen !!}</td>
                </tr>
                <tr>
                  <td style="border : none"><strong>Nama Pemesan  </strong></td>
                  <td style="border : none">: {!! $pemesanan->nama_pemesanan !!}</td>
                </tr>
                <tr>
                  <td style="border : none"><strong>Lokasi Proyek  </strong></td>
                  <td style="border : none">: {!! $pemesanan->lokasi_proyek !!}</td>
                </tr>
                <tr>
                  <td style="border : none"><strong>Produk  </strong></td>
                  <td style="border : none">: {!! $pemesanan->produk->mutu_produk !!}</td>
                </tr>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="pull-right">
            <table>
              <tbody>
                <tr>
                  <td style="border : none"><strong>Satuan  </strong></td>
                  <td style="border : none">: {!!$pemesanan->produk->satuan !!}</td>
                </tr>
                <tr>
                  <td style="border : none"><strong>Volume Pesanan  </strong></td>
                  <td style="border : none">: {!! $pesanan = $pemesanan->volume_pesanan !!}</td>
                </tr>
                <tr>
                  <td style="border : none"><strong>Realisasi  </strong></td>
                  <td style="border : none">: {!! $produksi = $produksis->sum('volume') !!}</td>
                </tr>
                <tr>
                  <td style="border : none"><strong>Sisa  </strong></td>
                  <td style="border : none">: {!! $pesanan-$produksi !!}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="clearfix">

          </div>
          <br>

<table class="table table-bordered text-center">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th class="text-center">No. Dokumen</th>
            <th class="text-center">Tanggal Pengiriman</th>
            <th class="text-center">No. Polisi</th>
            <th class="text-center">Pengirim</th>
            <th class="text-center">Penerima</th>
            <th class="text-center">Volume</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($produksis as $key => $produksi)
          <tr>
            <td>{{$key+1}}</td>
            <td>{{$produksi->nomor_dokumen}}</td>
            <td>{{$produksi->waktu_produksi->format('d F Y h:m')}}</td>
            <td>{{$produksi->kendaraan->no_polisi}}</td>
            <td>{{$produksi->nama_pengirim}}</td>
            <td>{{$produksi->nama_penerima}}</td>
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
