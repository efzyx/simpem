<table class="table table-responsive" id="pemesanans-table">
    <thead>
        <tr>
          <th>#</th>
            <th>Nama Pemesana</th>
        <th>Produk</th>
        <th>Pemesanan</th>
        <th>Jenis Pesanan</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
      @php
        $no = 1;
        $jenis = ['Retail', 'Non Retail'];
        $status = [
          'Produksi',
          'Sedang dikirim',
          'Terkirim'
        ];
      @endphp
    @foreach($pemesanans as $pemesanan)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{!! $pemesanan->nama_pemesanan !!}</td>
            <td>{!! $pemesanan->produk->mutu_produk !!}</td>
            <td>{!! $pemesanan->tanggal_pesanan->diffForHumans() !!}</td>
            <td>{!! $jenis[$pemesanan->jenis_pesanan] !!}</td>
            <td>{!! $status[$pemesanan->status] !!}</td>
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
