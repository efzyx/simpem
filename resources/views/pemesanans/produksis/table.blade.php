<table class="table table-responsive" id="produksis-table">
  <thead>
    <tr>
      <th>#</th>
      <th>Kendaraan</th>
      <th>Volume</th>
      <th>Waktu Produksi</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @php $no =1; $status = [ 'Sedang Produksi', 'Sedang Dikirim', 'Terkirim' ]; @endphp @foreach($produksis as $produksi)
    <tr>
      <td>{{ $no++ }}</td>
      <td>{{ $kendaraans[$produksi->kendaraan->id] }}</td>
      <td>{!! $produksi->volume !!}</td>
      <td>{!! $produksi->waktu_produksi->diffForHumans() !!}</td>
      <td>
        {!! Form::open(['route' => ['pemesanans.produksis.destroy', $pemesanan, $produksi->id], 'method' => 'delete']) !!}
        <div class='btn-group'>
          @if (Auth::user()->is('produksi') || Auth::user()->is('manager_produksi'))
            <a href="{!! route('pemesanans.produksis.show', [$pemesanan, $produksi->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            <a href="{!! route('pemesanans.produksis.edit', [$pemesanan, $produksi->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a> {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit',
            'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
          @endif
        </div>
        {!! Form::close() !!}
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
