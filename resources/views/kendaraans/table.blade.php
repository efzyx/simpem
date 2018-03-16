<table class="table table-responsive" id="kendaraans-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Jenis Kendaraan</th>
            <th>No Polisi</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
      @php
      $no = 1;
      @endphp
    @foreach($kendaraans as $kendaraan)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{!! $kendaraan->jenis_kendaraan !!}</td>
            <td>{!! $kendaraan->no_polisi !!}</td>
            <td>
                {!! Form::open(['route' => ['kendaraans.destroy', $kendaraan->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('kendaraans.show', [$kendaraan->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('kendaraans.edit', [$kendaraan->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>