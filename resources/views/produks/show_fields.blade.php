<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $produk->id !!}</p>
</div>

<!-- Nama Produk Field -->
<div class="form-group">
    {!! Form::label('nama_produk', 'Nama Produk:') !!}
    <p>{!! $produk->nama_produk !!}</p>
</div>

<!-- Harga Satuan Field -->
<div class="form-group">
    {!! Form::label('harga_satuan', 'Harga Satuan:') !!}
    <p>{!! $produk->harga_satuan !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $produk->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $produk->updated_at !!}</p>
</div>

