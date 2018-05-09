<!-- Berat Field -->
<div class="form-group col-sm-12">
    {!! Form::label('berat', 'Kuantitas:') !!}
    {!! Form::number('berat', null, ['class' => 'form-control', 'step' => 'any']) !!}
</div>


{!! Form::hidden('pemesanan_bahan_baku_id', $supplier->id) !!}

<!-- Supir Field -->
<div class="form-group col-sm-12">
    {!! Form::label('supir', 'No Polisi:') !!}
    {!! Form::text('supir', null, ['class' => 'form-control']) !!}
</div>

<!-- Tanggal Pengadaan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('tanggal_pengadaan', 'Tanggal Penerimaan:') !!}
    {!! Form::text('tanggal_pengadaan', null, ['class' => 'form-control datetimepicker'] ) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::text('keterangan', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('supplier.pengadaans.index', $supplier) !!}" class="btn btn-default">Cancel</a>
</div>
