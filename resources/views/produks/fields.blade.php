<!-- Nama Produk Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama_produk', 'Nama Produk:') !!}
    {!! Form::text('nama_produk', null, ['class' => 'form-control']) !!}
</div>

<!-- Harga Satuan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('harga_satuan', 'Harga Satuan:') !!}
    {!! Form::text('harga_satuan', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('produks.index') !!}" class="btn btn-default">Cancel</a>
</div>
