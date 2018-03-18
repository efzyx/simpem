<table class="table table-responsive" id="pemesanans-table">
    <thead>
        <tr>
          <th width="5px">#</th>
          <th>Pemesan</th>
          <th>Produk</th>
          <th>Tanggal</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
    </thead>
    <tbody>
      @php
        $no = 1;
        $status = [
          'Produksi',
          'Sedang dikirim',
          'Terkirim'
        ];
      @endphp
    @foreach($pemesanans as $pemesanan)
        <tr>
            <td width="5px">{{ $no++ }}</td>
            <td>{!! $pemesanan->nama_pemesanan !!}</td>
            <td>{!! $pemesanan->produk->mutu_produk !!}</td>
            <td>{!! $pemesanan->tanggal_pesanan->format('d F y') !!}</td>
            <td>{!! $status[$pemesanan->status] !!}</td>
            <td>
                {!! Form::open(['route' => ['pemesanans.destroy', $pemesanan->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('pemesanans.produksis.index', [$pemesanan->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-refresh"></i></a>
                    <a href="{!! route('pemesanans.show', [$pemesanan->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('pemesanans.edit', [$pemesanan->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
      <tr>
        <th width="5px"></th>
        <th><input type="text" placeholder="Search Pemesan" /></th>
        <th><input type="text" placeholder="Search Produk" /></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </tfoot>
</table>
