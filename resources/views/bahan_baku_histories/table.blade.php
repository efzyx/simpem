<table class="table table-responsive" id="bahanBakuHistories-table">
    <thead>
        <tr>
          <th>#</th>
        <th>Bahan Baku</th>
        <th>Type</th>
        <th>Volume</th>
        <th>Total Sisa</th>
        </tr>
    </thead>
    <tbody>
      @php
        $no = 1
      @endphp
    @foreach($bahanBakuHistories as $bahanBakuHistory)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{!! $bahanBakuHistory->bahan_baku->nama_bahan_baku !!}</td>
            @if ($produksi = $bahanBakuHistory->produksi)
              <td><a href="{{ route('pemesanans.produksis.show', [$produksi->pemesanan, $produksi])}}">Produksi</a></td>
            @elseif ($pengadaan = $bahanBakuHistory->pengadaan)
              <td><a href="{{ route('pengadaans.show', $pengadaan->id)}}">Pengadaan</a></td>
            @else
              <td><a href="{{ route('opnames.show', $bahanBakuHistory->opname->id)}}">Pengadaan</a></td>
            @endif

            <td>{{ abs($bahanBakuHistory->volume) }}</td>
            <td>{!! $bahanBakuHistory->total_sisa !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>
