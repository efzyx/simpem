<table class="table table-responsive" id="pemesanans-table">
    <thead>
        <tr>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Quantity</th>
            <th colspan="1">Action</th>
        </tr>
    </thead>
    <tbody>
      @php
        $total = 0;
      @endphp
    @foreach($produk_pesan as $produk)
        <tr>
            <td>{!! $produkCollection->find($produk->produk_id)->nama_produk !!}</td>
            <td>{!! $harga = $produkCollection->find($produk->produk_id)->harga_satuan !!}</td>
            <td>{!! $q = $produk->quantity !!}</td>
            <td>
                {!! Form::open(['route' => ['destroyPesanan', $produk->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
            @php
              $total += $harga * $q;
            @endphp
        </tr>
    @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2"><b>Total</b></td>
        <td><b>{{ $total }}</b></td>
      </tr>
    </tfoot>
</table>
