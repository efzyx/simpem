<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $pemesanan->id !!}</p>
</div>

<!-- Nama Pemesanan Field -->
<div class="form-group">
    {!! Form::label('nama_pemesanan', 'Nama Pemesanan:') !!}
    <p>{!! $pemesanan->nama_pemesanan !!}</p>
</div>

<!-- Tanggal Pesan Field -->
<div class="form-group">
    {!! Form::label('tanggal_pesan', 'Tanggal Pesan:') !!}
    <p>{!! $pemesanan->tanggal_pesan !!}</p>
</div>

<!-- Lokasi Field -->
<div class="form-group">
    {!! Form::label('lokasi', 'Lokasi:') !!}
    <p>{!! $pemesanan->lokasi !!}</p>
</div>

<!-- Contact Person Field -->
<div class="form-group">
    {!! Form::label('contact_person', 'Contact Person:') !!}
    <p>{!! $pemesanan->contact_person !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $pemesanan->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $pemesanan->updated_at !!}</p>
</div>

