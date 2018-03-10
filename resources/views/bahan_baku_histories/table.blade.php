<table class="table table-responsive" id="bahanBakuHistories-table">
    <thead>
        <tr>
            <th>Bahan Baku Id</th>
        <th>Type</th>
        <th>Pengadaan Id</th>
        <th>Produksi Id</th>
        <th>Opname Id</th>
        <th>Total Sisa</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($bahanBakuHistories as $bahanBakuHistory)
        <tr>
            <td>{!! $bahanBakuHistory->bahan_baku_id !!}</td>
            <td>{!! $bahanBakuHistory->type !!}</td>
            <td>{!! $bahanBakuHistory->pengadaan_id !!}</td>
            <td>{!! $bahanBakuHistory->produksi_id !!}</td>
            <td>{!! $bahanBakuHistory->opname_id !!}</td>
            <td>{!! $bahanBakuHistory->total_sisa !!}</td>
            <td>
                {!! Form::open(['route' => ['bahanBakuHistories.destroy', $bahanBakuHistory->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('bahanBakuHistories.show', [$bahanBakuHistory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('bahanBakuHistories.edit', [$bahanBakuHistory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>