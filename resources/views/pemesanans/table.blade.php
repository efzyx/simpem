<table class="table table-responsive" id="pemesanans-table">
    <thead>
        <tr>
            <th>Nama Pemesanan</th>
        <th>Tanggal Pesan</th>
        <th>Lokasi</th>
        <th>Contact Person</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($pemesanans as $pemesanan)
        <tr>
            <td>{!! $pemesanan->nama_pemesanan !!}</td>
            <td>{!! $pemesanan->tanggal_pesan !!}</td>
            <td>{!! $pemesanan->lokasi !!}</td>
            <td>{!! $pemesanan->contact_person !!}</td>
            <td>
                {!! Form::open(['route' => ['pemesanans.destroy', $pemesanan->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('detailPemesanan', [$pemesanan->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-plus"></i></a>
                    <a href="{!! route('pemesanans.show', [$pemesanan->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('pemesanans.edit', [$pemesanan->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
