<table class="table table-responsive" id="produks-table">
    <thead>
        <tr>
            <th>Nama Produk</th>
        <th>Harga Satuan</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($produks as $produk)
        <tr>
            <td>{!! $produk->nama_produk !!}</td>
            <td>{!! $produk->harga_satuan !!}</td>
            <td>
                {!! Form::open(['route' => ['produks.destroy', $produk->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('produks.show', [$produk->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('produks.edit', [$produk->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>