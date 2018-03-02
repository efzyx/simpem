<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $produk->id !!}</p>
</div>

<!-- Mutu Produk Field -->
<div class="form-group">
    {!! Form::label('mutu_produk', 'Mutu Produk:') !!}
    <p>{!! $produk->mutu_produk !!}</p>
</div>

<!-- Satuan Field -->
<div class="form-group">
    {!! Form::label('satuan', 'Satuan:') !!}
    <p>{!! $produk->satuan !!}</p>
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

