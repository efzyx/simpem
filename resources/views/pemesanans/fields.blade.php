<!-- Nama Pemesana Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama_pemesanan', 'Nama Pemesana:') !!}
    {!! Form::text('nama_pemesanan', null, ['class' => 'form-control']) !!}
</div>

<!-- Produk Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('produk_id', 'Produk Id:') !!}
    {!! Form::text('produk_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Volume Pesanan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('volume_pesanan', 'Volume Pesanan:') !!}
    {!! Form::number('volume_pesanan', null, ['class' => 'form-control']) !!}
</div>

<!-- Tanggal Pesanan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tanggal_pesanan', 'Tanggal Pesanan:') !!}
    {!! Form::date('tanggal_pesanan', null, ['class' => 'form-control']) !!}
</div>

<!-- Tanggal Kirim Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tanggal_kirim', 'Tanggal Kirim:') !!}
    {!! Form::date('tanggal_kirim', null, ['class' => 'form-control']) !!}
</div>

<!-- Lokasi Proyek Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lokasi_proyek', 'Lokasi Proyek:') !!}
    {!! Form::text('lokasi_proyek', null, ['class' => 'form-control']) !!}
</div>

<!-- Jenis Pesanan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jenis_pesanan', 'Jenis Pesanan:') !!}
    {!! Form::text('jenis_pesanan', null, ['class' => 'form-control']) !!}
</div>

<!-- Cp Pesanan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cp_pesanan', 'Cp Pesanan:') !!}
    {!! Form::text('cp_pesanan', null, ['class' => 'form-control']) !!}
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

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('pemesanans.index') !!}" class="btn btn-default">Cancel</a>
</div>
