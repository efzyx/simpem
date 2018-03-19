<table class="table table-responsive" id="opnames-table">
    <thead>
        <tr>
            <th>Bahan Baku</th>
        <th>Volume Opname</th>
        <th>Keterangan</th>
        <th>Tanggal Pemakaian</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($opnames as $opname)
        <tr>
            <td>{!! $opname->bahan_baku->nama_bahan_baku !!}</td>
            <td>{!! $opname->volume_opname !!}</td>
            <td>{!! $opname->keterangan !!}</td>
            <td>{!! $opname->tanggal_pemakaian !!}</td>
            <td>
                {!! Form::open(['route' => ['opnames.destroy', $opname->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('opnames.show', [$opname->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('opnames.edit', [$opname->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
