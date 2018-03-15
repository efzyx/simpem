<!-- Kendaraan Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('kendaraan_id', 'Kendaraan Id:') !!}
    {!! Form::select('kendaraan_id', $kendaraans, null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', $stt, null, ['class' => 'form-control']) !!}
</div>

<!-- Waktu Field -->
<div class="form-group col-sm-12">
    {!! Form::label('waktu', 'Waktu:') !!}
    {!! Form::text('waktu', null, ['class' => 'form-control','id'=>'calendar1']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('kendaraanDetails.index') !!}" class="btn btn-default">Cancel</a>
</div>
