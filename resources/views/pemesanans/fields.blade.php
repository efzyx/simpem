<!-- Nama Pemesanan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama_pemesanan', 'Nama Pemesanan:') !!}
    {!! Form::text('nama_pemesanan', null, ['class' => 'form-control']) !!}
</div>

<!-- Tanggal Pesan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tanggal_pesan', 'Tanggal Pesan:') !!}
    {!! Form::date('tanggal_pesan', null, ['class' => 'form-control']) !!}
</div>

<!-- Lokasi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lokasi', 'Lokasi:') !!}
    {!! Form::text('lokasi', null, ['class' => 'form-control']) !!}
</div>

<!-- Contact Person Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contact_person', 'Contact Person:') !!}
    {!! Form::text('contact_person', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('pemesanans.index') !!}" class="btn btn-default">Cancel</a>
</div>
