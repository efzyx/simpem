<table class="table table-responsive" id="produksis-table">
    <thead>
        <tr>
        <th>#</th>
        <th>Pemesanan</th>
        <th>Volume</th>
        <th>Waktu Produksi</th>
        <th>No Kendaraan</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
      @php
        $no =1
      @endphp
    @foreach($produksis as $produksi)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{!! $produksi->pemesanan->nama_pemesanan !!}</td>
            <td>{!! $produksi->volume !!}</td>
            <td>{!! $produksi->waktu_produksi->diffForHumans() !!}</td>
            <td>{!! $produksi->no_kendaraan !!}</td>
            <td>
                {!! Form::open(['route' => ['produksis.destroy', $produksi->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('produksis.show', [$produksi->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('produksis.edit', [$produksi->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
