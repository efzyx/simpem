<!-- Material Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('bahan_baku_id', 'Material:') !!}
    {!! Form::select('bahan_baku_id', $bahanBakus, null, ['class' => 'form-control']) !!}
</div>

<!-- Volume Material Keluar Field -->
<div class="form-group col-sm-12">
    {!! Form::label('volume_opname', 'Volume Material Keluar:') !!}
    {!! Form::number('volume_opname', null, ['class' => 'form-control numb', 'step' => 'any']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::text('keterangan', null, ['class' => 'form-control']) !!}
</div>

<!-- Tanggal Pemakaian Field -->
<div class="form-group col-sm-12">
    {!! Form::label('tanggal_pemakaian', 'Tanggal Pemakaian:') !!}
    {!! Form::text('tanggal_pemakaian', null, ['class' => 'form-control datetimepicker']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('opnames.index') !!}" class="btn btn-default">Cancel</a>
</div>
