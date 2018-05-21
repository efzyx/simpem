<div class="table-responsive">
  <table class="table" id="bahanBakuHistories-table">
    <thead>
      <tr>
        <th>#</th>
        <th>Waktu</th>
        <th>Material</th>
        <th>Type</th>
        <th>Volume</th>
        <th>Total Sisa</th>
      </tr>
    </thead>
    <tbody>
      @php $no = 1 @endphp @foreach($bahanBakuHistories as $bahanBakuHistory)
      <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $bahanBakuHistory->waktu->format('d F Y h:m')}}</td>
        <td>{!! $bahanBakuHistory->bahan_baku->nama_bahan_baku !!}</td>
        @if ($produksi = $bahanBakuHistory->produksi)
        <td><a href="{{ route('pemesanans.produksis.show', [$produksi->pemesanan, $produksi])}}">Produksi</a></td>
        @elseif ($pengadaan = $bahanBakuHistory->pengadaan)
        <td><a href="{{ route('pengadaans.show', $pengadaan->id)}}">Pengadaan</a></td>
        @else
        <td><a href="{{ route('opnames.show', $bahanBakuHistory->opname->id)}}">Material Keluar</a></td>
        @endif

        <td>{{ abs($bahanBakuHistory->volume) }}</td>
        <td>{!! $bahanBakuHistory->total_sisa !!}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
