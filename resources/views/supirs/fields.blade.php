<!-- No Supir Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_supir', 'No Supir:') !!}
    {!! Form::text('no_supir', null, ['class' => 'form-control']) !!}
</div>

<!-- Nama Supir Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama_supir', 'Nama Supir:') !!}
    {!! Form::text('nama_supir', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('supirs.index') !!}" class="btn btn-default">Cancel</a>
</div>
