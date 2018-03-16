<table class="table table-responsive" id="kendaraanDetails-table">
    <thead>
        <tr>
          <th>#</th>
            <th>Kendaraan Id</th>
        <th>Status</th>
        <th>Waktu</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
      @php
      $no = 1;
      @endphp
    @foreach($kendaraanDetails as $kendaraanDetail)
        <tr>
          <td>{!! $no++ !!}</td>
            <td>{!! $kendaraanDetail->kendaraan->jenis_kendaraan !!}</td>
            <td>{!! $stt[$kendaraanDetail->status] !!}</td>
            <td>{!! $kendaraanDetail->waktu->diffForHumans() !!}</td>
            <td>
                {!! Form::open(['route' => ['kendaraanDetails.destroy', $kendaraanDetail->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('kendaraanDetails.show', [$kendaraanDetail->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('kendaraanDetails.edit', [$kendaraanDetail->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
