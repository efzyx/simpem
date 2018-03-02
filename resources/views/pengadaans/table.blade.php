<table class="table table-responsive" id="pengadaans-table">
    <thead>
        <tr>
            <th>Bahan Baku Id</th>
        <th>Berat</th>
        <th>Supplier</th>
        <th>Tanggal Pengadaan</th>
        <th>User Id</th>
        <th>Keterangan</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($pengadaans as $pengadaan)
        <tr>
            <td>{!! $pengadaan->bahan_baku_id !!}</td>
            <td>{!! $pengadaan->berat !!}</td>
            <td>{!! $pengadaan->supplier !!}</td>
            <td>{!! $pengadaan->tanggal_pengadaan !!}</td>
            <td>{!! $pengadaan->user_id !!}</td>
            <td>{!! $pengadaan->keterangan !!}</td>
            <td>
                {!! Form::open(['route' => ['pengadaans.destroy', $pengadaan->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('pengadaans.show', [$pengadaan->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('pengadaans.edit', [$pengadaan->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>