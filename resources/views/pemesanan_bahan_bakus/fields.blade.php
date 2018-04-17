<!-- Nama Supplier Field -->
<div class="form-group col-sm-12">
    {!! Form::label('nama_supplier', 'Nama Supplier:') !!}
    {!! Form::text('nama_supplier', null, ['class' => 'form-control']) !!}
</div>

<!-- Cp Supplier Field -->
<div class="form-group col-sm-12">
    {!! Form::label('cp_supplier', 'Cp Supplier:') !!}
    {!! Form::number('cp_supplier', null, ['class' => 'form-control']) !!}
</div>

<!-- Bahan Baku Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('bahan_baku_id', 'Bahan Baku Id:') !!}
    {!! Form::select('bahan_baku_id', $bahanBakus, null, ['class' => 'form-control']) !!}
</div>

<!-- Volume Pemesanan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('volume_pemesanan', 'Volume Pemesanan:') !!}
    {!! Form::number('volume_pemesanan', null, ['class' => 'form-control']) !!}
</div>

<!-- Tanggal Pemesanan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('tanggal_pemesanan', 'Tanggal Pemesanan:') !!}
    {!! Form::text('tanggal_pemesanan', null, ['class' => 'form-control','id' => 'calendar1']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::text('keterangan', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('pemesananBahanBakus.index') !!}" class="btn btn-default">Cancel</a>
</div>
