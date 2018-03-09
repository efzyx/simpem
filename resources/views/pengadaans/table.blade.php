<table class="table table-responsive" id="pengadaans-table">
    <thead>
        <tr>
        <th>#</th>
        <th>Bahan Baku</th>
        <th>Berat</th>
        <th>Supplier</th>
        <th>Tanggal Pengadaan</th>
        <th>Keterangan</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
      @php
      $no = 1;
      @endphp
    @foreach($pengadaans as $pengadaan)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{!! $pengadaan->bahan_baku->nama_bahan_baku !!}</td>
            <td>{!! $pengadaan->berat !!}</td>
            <td>{!! $pengadaan->supplier !!}</td>
            <td>{!! $pengadaan->tanggal_pengadaan->diffForHumans() !!}</td>
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
