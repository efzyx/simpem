
<!-- Status Field -->
<div class="form-group col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', $status, null, ['class' => 'form-control']) !!}
</div>

<!-- Waktu Field -->
<div class="form-group col-sm-12">
    {!! Form::label('waktu', 'Waktu:') !!}
    {!! Form::text('waktu', null, ['class' => 'form-control datetimepicker']) !!}
</div>
