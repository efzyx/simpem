<!-- Nama Bahan Baku Field -->
<div class="form-group col-sm-12">
    {!! Form::label('nama_bahan_baku', 'Nama Bahan Baku:') !!}
    {!! Form::text('nama_bahan_baku', null, ['class' => 'form-control']) !!}
</div>

<!-- Satuan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('satuan', 'Satuan:') !!}
    {!! Form::text('satuan', null, ['class' => 'form-control']) !!}
</div>

<!-- Sisa Field -->
<div class="form-group col-sm-12">
    {!! Form::label('sisa', 'Sisa:') !!}
    {!! Form::number('sisa', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('bahanBakus.index') !!}" class="btn btn-default">Cancel</a>
</div>
