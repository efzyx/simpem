<!-- Bahan Baku Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('bahan_baku_id', 'Bahan Baku:') !!}
    {!! Form::select('bahan_baku_id', $bahanBakus, null, ['class' => 'form-control']) !!}
</div>

<!-- Volume Opname Field -->
<div class="form-group col-sm-12">
    {!! Form::label('volume_opname', 'Volume Opname:') !!}
    {!! Form::number('volume_opname', null, ['class' => 'form-control']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::text('keterangan', null, ['class' => 'form-control']) !!}
</div>

<!-- Tanggal Pemakaian Field -->
<div class="form-group col-sm-12">
    {!! Form::label('tanggal_pemakaian', 'Tanggal Pemakaian:') !!}
    {!! Form::text('tanggal_pemakaian', null, ['class' => 'form-control','id' => 'calendar1']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('opnames.index') !!}" class="btn btn-default">Cancel</a>
</div>
