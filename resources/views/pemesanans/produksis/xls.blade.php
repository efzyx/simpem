<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Export Excel Rekapitulasi Produksi</title>
  </head>
  <body>
      <strong>Rekapitulasi Produksi</strong>
      <br><br>
          @foreach ($pemesanans as $pemesanan)
          @php
          $i=0;
          $produksis = \App\Models\Produksi::hydrate($pemesanan->produksis);
          $produksis = $produksis->flatten();
          $sisa = $produksis->sum('volume');

          @endphp
          <div>
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

          <br>

<table>
        <thead>
          <tr>
            <th>No</th>
            <th>No. Dokumen</th>
            <th>Tanggal Pengiriman</th>
            <th>No. Polisi</th>
            <th>Penerima</th>
            <th>Volume</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($produksis as $key => $produksi)
          <tr>
            <td>{{$key+1}}</td>
            <td>{{$produksi->nomor_dokumen}}</td>
            <td>{{$produksi->waktu_produksi->format('d F Y h:m')}}</td>
            <td>{{$produksi->kendaraan->no_polisi}}</td>
            <td>{{$produksi->nama_penerima}}</td>
            <td>{{$produksi->volume}}</td>
          </tr>
          @endforeach

          @endforeach
        </tbody>
      </table>
  </body>
</html>
