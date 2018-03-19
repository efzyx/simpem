<div class="table-responsive">
  <table class="table" id="pemesanans-table">
    <thead>
      <tr>
        <th width="15vw">#</th>
        <th width="100vw">Pemesan</th>
        <th width="100vw">Produk</th>
        <th width="100vw">Tanggal</th>
        <th width="100vw">Status</th>
        <th width="100vw">Action</th>
      </tr>
    </thead>
    <tbody>
      @php $no = 1; $status = [ 'Produksi', 'Sedang dikirim', 'Terkirim' ]; @endphp @foreach($pemesanans as $pemesanan)
      <tr>
        <td width="15vw">{{ $no++ }}</td>
        <td width="100vw">{!! $pemesanan->nama_pemesanan !!}</td>
        <td width="100vw">{!! $pemesanan->produk->mutu_produk !!}</td>
        <td width="100vw">{!! $pemesanan->tanggal_pesanan->format('d F y') !!}</td>
        <td width="100vw">{!! $status[$pemesanan->status] !!}</td>
        <td width="100vw">
          {!! Form::open(['route' => ['pemesanans.destroy', $pemesanan->id], 'method' => 'delete']) !!}
          <div class='btn-group'>
            <a href="{!! route('pemesanans.produksis.index', [$pemesanan->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-refresh"></i></a>
            <a href="{!! route('pemesanans.show', [$pemesanan->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            <a href="{!! route('pemesanans.edit', [$pemesanan->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a> {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger
            btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
          </div>
          {!! Form::close() !!}
        </td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <th width="15vw"></th>
        <th width="100vw"><input class="col-sm-12" type="text" placeholder="Pemesan" /></th>
        <th width="100vw"><input class="col-sm-12" type="text" placeholder="Produk" /></th>
        <th width="100vw"><input class="col-sm-12" type="text" placeholder="Tanggal" /></th>
        <th width="100vw"></th>
        <th width="100vw"></th>
      </tr>
    </tfoot>
  </table>
</div>
