<!-- Bahan Baku Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('bahan_baku_id', 'Bahan Baku:') !!}
    {!! Form::select('bahan_baku_id', $bahanBakus, null, ['class' => 'form-control']) !!}
</div>

<!-- Berat Field -->
<div class="form-group col-sm-12">
    {!! Form::label('berat', 'Kuantitas:') !!}
    {!! Form::number('berat', null, ['class' => 'form-control']) !!}
</div>

<!-- Supplier Field -->
<div class="form-group col-sm-12">
    {!! Form::label('supplier', 'Supplier:') !!}
    {!! Form::text('supplier', null, ['class' => 'form-control']) !!}
</div>

<!-- Supir Field -->
<div class="form-group col-sm-12">
    {!! Form::label('supir', 'Supir/No Polisi:') !!}
    {!! Form::text('supir', null, ['class' => 'form-control']) !!}
</div>

<!-- Tanggal Pengadaan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('tanggal_pengadaan', 'Tanggal Pengadaan:') !!}
    {!! Form::text('tanggal_pengadaan', null, ['class' => 'form-control','id' => 'calendar1'] ) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::text('keterangan', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('pengadaans.index') !!}" class="btn btn-default">Cancel</a>
</div>
