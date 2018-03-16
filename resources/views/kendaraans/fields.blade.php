

<!-- Submit Field -->
<!-- Supplier Field -->
<div class="form-group col-sm-12">
    {!! Form::label('jenis_kendaraan', 'Jenis Kendaraan:') !!}
    {!! Form::text('jenis_kendaraan', null, ['class' => 'form-control']) !!}
</div>

<!-- Supplier Field -->
<div class="form-group col-sm-12">
    {!! Form::label('no_polisi', 'No Polisi') !!}
    {!! Form::text('no_polisi', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('kendaraans.index') !!}" class="btn btn-default">Cancel</a>
</div>
