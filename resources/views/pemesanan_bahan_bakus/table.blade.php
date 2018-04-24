<table class="table table-responsive" id="pemesananBahanBakus-table">
    <thead>
        <tr>
        <th>#</th>
        <th>Supplier</th>
        <th>Bahan Baku</th>
        <th>Volume</th>
        <th>Tanggal</th>
        <th>Action</th>
        </tr>
    </thead>
    <tbody>
      @php
        $no = 1;
      @endphp
    @foreach($pemesananBahanBakus as $pemesananBahanBaku)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{!! $pemesananBahanBaku->nama_supplier !!}</td>
            <td>{!! $bahan_baku[$pemesananBahanBaku->bahan_baku_id] !!}</td>
            <td>{!! $pemesananBahanBaku->volume_pemesanan !!}</td>
            <td>{!! $pemesananBahanBaku->tanggal_pemesanan !!}</td>
            <td>
                {!! Form::open(['route' => ['pemesananBahanBakus.destroy', $pemesananBahanBaku->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('suppliers.pengadaans.index', [$pemesananBahanBaku]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-refresh"></i></a>
                    <a href="{!! route('pemesananBahanBakus.show', [$pemesananBahanBaku->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('pemesananBahanBakus.edit', [$pemesananBahanBaku->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
