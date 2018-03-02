<table class="table table-responsive" id="pemesanans-table">
    <thead>
        <tr>
            <th>Nama Pemesana</th>
        <th>Produk Id</th>
        <th>Volume Pesanan</th>
        <th>Tanggal Pesanan</th>
        <th>Tanggal Kirim</th>
        <th>Lokasi Proyek</th>
        <th>Jenis Pesanan</th>
        <th>Cp Pesanan</th>
        <th>User Id</th>
        <th>Keterangan</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($pemesanans as $pemesanan)
        <tr>
            <td>{!! $pemesanan->nama_pemesanan !!}</td>
            <td>{!! $pemesanan->produk_id !!}</td>
            <td>{!! $pemesanan->volume_pesanan !!}</td>
            <td>{!! $pemesanan->tanggal_pesanan !!}</td>
            <td>{!! $pemesanan->tanggal_kirim !!}</td>
            <td>{!! $pemesanan->lokasi_proyek !!}</td>
            <td>{!! $pemesanan->jenis_pesanan !!}</td>
            <td>{!! $pemesanan->cp_pesanan !!}</td>
            <td>{!! $pemesanan->user_id !!}</td>
            <td>{!! $pemesanan->keterangan !!}</td>
            <td>{!! $pemesanan->status !!}</td>
            <td>
                {!! Form::open(['route' => ['pemesanans.destroy', $pemesanan->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
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