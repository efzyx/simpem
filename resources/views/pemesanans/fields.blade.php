<!-- Nama Pemesana Field -->
<div class="form-group col-sm-12">
    {!! Form::label('nama_pemesanan', 'Nama Pemesanan:') !!}
    {!! Form::text('nama_pemesanan', null, ['class' => 'form-control']) !!}
</div>

<!-- Produk Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('produk_id', 'Produk:') !!}
{!! Form::select('produk_id', $produks , null, ['class' => 'form-control']) !!}</div>

<!-- Volume Pesanan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('volume_pesanan', 'Volume Pesanan:') !!}
    {!! Form::number('volume_pesanan', null, ['class' => 'form-control', 'step' => 'any']) !!}
</div>

<!-- Tanggal Pesanan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('tanggal_pesanan', 'Waktu Pemesanan:') !!}
    {!! Form::text('tanggal_pesanan', null, ['class' => 'form-control datetimepicker'])!!}
</div>

<!-- Tanggal Kirim Field -->
<div class="form-group col-sm-12">
    {!! Form::label('tanggal_kirim', 'Waktu Kirim:') !!}
    <br>
    <div class="col-sm-6">
      {!! Form::text('tanggal_kirim_dari', null, ['class' => 'form-control datetimepicker', 'placeholder' => 'Dari...'])!!}
    </div>
    <div class="col-sm-6">
      {!! Form::text('tanggal_kirim_sampai', null, ['class' => 'form-control datetimepicker', 'placeholder' => 'Sampai...'])!!}
    </div>
</div>

<!-- Lokasi Proyek Field -->
<div class="form-group col-sm-12">
    {!! Form::label('lokasi_proyek', 'Lokasi Proyek:') !!}
    {!! Form::text('lokasi_proyek', null, ['class' => 'form-control']) !!}
</div>

<!-- Jenis Pesanan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('jenis_pesanan', 'Jenis Pesanan:') !!}
    {!! Form::select('jenis_pesanan', ['Retail', 'Non Retail'], null, ['class' => 'form-control']) !!}
</div>

<!-- Cp Pesanan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('cp_pesanan', 'CP Pesanan:') !!}
    {!! Form::text('cp_pesanan', null, ['class' => 'form-control']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::text('keterangan', null, ['class' => 'form-control']) !!}
</div>

    {!! Form::hidden('status', 0) !!}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('pemesanans.index') !!}" class="btn btn-default">Cancel</a>
</div>
