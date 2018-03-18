<table class="table table-responsive" id="pengiriman-table">
    <thead>
        <tr>
        <th>#</th>
        <th>Status</th>
        <th>Waktu</th>
        <th>Pegawai</th>
        </tr>
    </thead>
    <tbody>
      @php
        $no =1;
        $status = [
          'Sedang Produksi',
          'Sedang Dikirim',
          'Terkirim'
        ];
      @endphp
    @foreach($pengirimans as $pengiriman)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{!! $status[$pengiriman->status] !!}</td>
            <td>{!! $pengiriman->created_at->format('d F y (h:i:s)')!!}</td>
            <td>{!! $pengiriman->user->name !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>
