<table class="table table-responsive" id="bahanBakus-table">
    <thead>
        <tr>
            <th>Nama Bahan Baku</th>
        <th>Satuan</th>
        <th>Sisa</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @forelse($bahanBakus as $bahanBaku)
        <tr>
            <td>{!! $bahanBaku->nama_bahan_baku !!}</td>
            <td>{!! $bahanBaku->satuan !!}</td>
            <td>{!! $bahanBaku->sisa !!}</td>
            <td>
                {!! Form::open(['route' => ['bahanBakus.destroy', $bahanBaku->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('bahanBakus.show', [$bahanBaku->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('bahanBakus.edit', [$bahanBaku->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @empty
      <tr>
        <td colspan="3" class="text-center">
          Belum ada data
        </td>
      </tr>
    @endforelse
    </tbody>
</table>
