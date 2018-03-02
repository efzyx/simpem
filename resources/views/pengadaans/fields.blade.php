<!-- Bahan Baku Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bahan_baku_id', 'Bahan Baku Id:') !!}
    {!! Form::text('bahan_baku_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Berat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('berat', 'Berat:') !!}
    {!! Form::number('berat', null, ['class' => 'form-control']) !!}
</div>

<!-- Supplier Field -->
<div class="form-group col-sm-6">
    {!! Form::label('supplier', 'Supplier:') !!}
    {!! Form::text('supplier', null, ['class' => 'form-control']) !!}
</div>

<!-- Tanggal Pengadaan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tanggal_pengadaan', 'Tanggal Pengadaan:') !!}
    {!! Form::date('tanggal_pengadaan', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::text('keterangan', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('pengadaans.index') !!}" class="btn btn-default">Cancel</a>
</div>
