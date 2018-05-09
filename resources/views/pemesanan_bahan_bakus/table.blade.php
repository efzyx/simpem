<table class="table table-responsive" id="pemesananBahanBakus-table">
    <thead>
        <tr>
        <th>#</th>
        <th>Supplier</th>
        <th>Bahan Baku</th>
        <th>Volume</th>
        <th>Sisa</th>
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
            <td>{!! $pemesananBahanBaku->bahan_baku->nama_bahan_baku !!}</td>
            <td>{!! $vol = $pemesananBahanBaku->volume_pemesanan !!}</td>
            <td>{!! $vol - $pemesananBahanBaku->pengadaans->sum('berat') !!}</td>
            <td>{!! $pemesananBahanBaku->tanggal_pemesanan !!}</td>
            <td>
                {!! Form::open(['route' => ['supplier.destroy', $pemesananBahanBaku->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('supplier.pengadaans.index', [$pemesananBahanBaku->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-refresh"></i></a>
                    <a href="{!! route('supplier.show', [$pemesananBahanBaku->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('supplier.edit', [$pemesananBahanBaku->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
