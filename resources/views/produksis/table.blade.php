<table class="table table-responsive" id="produksis-table">
    <thead>
        <tr>
            <th>Pemesanan Id</th>
        <th>Volume</th>
        <th>Semen</th>
        <th>Pasir</th>
        <th>Split</th>
        <th>Addictive</th>
        <th>Air</th>
        <th>Waktu Produksi</th>
        <th>Supir Id</th>
        <th>No Kendaraan</th>
        <th>User Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($produksis as $produksi)
        <tr>
            <td>{!! $produksi->pemesanan_id !!}</td>
            <td>{!! $produksi->volume !!}</td>
            <td>{!! $produksi->semen !!}</td>
            <td>{!! $produksi->pasir !!}</td>
            <td>{!! $produksi->split !!}</td>
            <td>{!! $produksi->addictive !!}</td>
            <td>{!! $produksi->air !!}</td>
            <td>{!! $produksi->waktu_produksi !!}</td>
            <td>{!! $produksi->supir_id !!}</td>
            <td>{!! $produksi->no_kendaraan !!}</td>
            <td>{!! $produksi->user_id !!}</td>
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