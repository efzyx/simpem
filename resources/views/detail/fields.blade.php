<!-- Nama Pemesanan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('produk_id', 'Produk :') !!}
    {!! Form::select('produk_id', $produks, null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('quantity', 'Quantity :') !!}
    {!! Form::text('quantity', null, ['class' => 'form-control']) !!}
</div>
{!! Form::hidden('pemesanan_id', $pemesanan_id) !!}
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('pemesanans.index') !!}" class="btn btn-default">Cancel</a>
</div>
