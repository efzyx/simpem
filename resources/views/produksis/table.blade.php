<table class="table" id="produksis-table">
  <thead>
    <tr>
      <th>#</th>
      <th>Pemesanan</th>
      <th>Kendaraan</th>
      <th>Volume</th>
      <th>Waktu Produksi</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @php $no =1; $status = [ 'Sedang Produksi', 'Sedang Dikirim', 'Terkirim' ];
    @endphp
    @foreach($produksis as $produksi)
    <tr>
      <td>{{ $no++ }}</td>
      <td>{!! $produksi->pemesanan->nama_pemesanan !!}</td>
      <td>{!! $kendaraans[$produksi->kendaraan->id] !!}</td>
      <td>{!! $produksi->volume !!}</td>
      <td>{!! $produksi->waktu_produksi->diffForHumans() !!}</td>
      <td>
        {!! Form::open(['route' => ['pemesanans.produksis.pengiriman.store', $produksi->pemesanan, $produksi], 'method' => 'post']) !!}
        {!! Form::select('status', $status , $produksi->pengirimans->last() ? $produksi->pengirimans->last()->status : null, ['class' => 'form-control status', 'placeholder' => 'Belum Diset']) !!}
        {!! Form::hidden('produksi_id', $produksi->id)!!}
        {!! Form::close() !!}
      </td>
      <td>
        {!! Form::open(['route' => ['produksis.destroy', $produksi->id], 'method' => 'delete']) !!}
        <div class='btn-group'>
          <a href="{!! route('pemesanans.produksis.pengiriman.index', [$produksi->pemesanan, $produksi]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-th-list"></i></a>
          <a href="{!! route('produksis.show', [$produksi->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>

          @if (Auth::user()->is('produksi') || Auth::user()->is('manager_produksi'))
            <a href="{!! route('produksis.edit', [$produksi->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
          @endif
        </div>
        {!! Form::close() !!}
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
