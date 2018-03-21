<table class="table table-responsive" id="jabatans-table">
    <thead>
        <tr>
          <th>#</th>
            <th>Nama Jabatan</th>
        <th>Keterangan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
      @php
      $no=1;
      @endphp
    @foreach($jabatans as $jabatan)
        <tr>
          <td>{!! $no++ !!}</td>
            <td>{!! $jabatan->nama_jabatan !!}</td>
            <td>{!! $jabatan->keterangan !!}</td>
            <td>
                {!! Form::open(['route' => ['jabatans.destroy', $jabatan->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('jabatans.show', [$jabatan->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('jabatans.edit', [$jabatan->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
