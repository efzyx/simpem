<!-- Id Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('id', 'Id') !!}
  </div>
  <div class="col-sm-9">
    {!! $pemesanan->id !!}
  </div>
</div>

<!-- Nama Pemesana Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('nama_pemesanan', 'Nama Pemesanan') !!}
  </div>
  <div class="col-sm-9">
    <p>{!! $pemesanan->nama_pemesanan !!}</p>
  </div>
</div>

<!-- Produk Id Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('produk_id', 'Produk') !!}
  </div>
  <div class="col-sm-9">
    <p>{!! $pemesanan->produk->mutu_produk !!}</p>
  </div>
</div>

<!-- Volume Pesanan Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('volume_pesanan', 'Volume Pesanan') !!}
  </div>
  <div class="col-sm-9">
    <p>{!! $pemesanan->volume_pesanan !!}</p>
  </div>
</div>

<!-- Tanggal Pesanan Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('tanggal_pesanan', 'Tanggal Pesanan') !!}
  </div>
  <div class="col-sm-9">
    <p>{!! $pemesanan->tanggal_pesanan->format('d F Y') !!}</p>
  </div>
</div>

<!-- Tanggal Kirim Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('tanggal_kirim', 'Tanggal Kirim') !!}
  </div>
  <div class="col-sm-9">
    <p>{!! $pemesanan->tanggal_kirim->format('d F Y') !!}</p>
  </div>
</div>

<!-- Lokasi Proyek Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('lokasi_proyek', 'Lokasi Proyek') !!}
  </div>
  <div class="col-sm-9">
    <p>{!! $pemesanan->lokasi_proyek !!}</p>
  </div>
</div>

<!-- Jenis Pesanan Field -->
@php
  $jenis = ['Retail', 'Non Retail'];
@endphp
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('jenis_pesanan', 'Jenis Pesanan') !!}
  </div>
  <div class="col-sm-9">
    <p>{!! $jenis[$pemesanan->jenis_pesanan] !!}</p>
  </div>
</div>

<!-- Cp Pesanan Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('cp_pesanan', 'CP Pesanan') !!}
  </div>
  <div class="col-sm-9">
    <p>{!! $pemesanan->cp_pesanan !!}</p>
  </div>
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('keterangan', 'Keterangan') !!}
  </div>
  <div class="col-sm-9">
    <p>{!! $pemesanan->keterangan !!}</p>
  </div>
</div>

<!-- Status Field -->
@php
  $status = [
    'Produksi',
    'Sedang dikirim',
    'Terkirim'
  ];
@endphp
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('status', 'Status') !!}
  </div>
  <div class="col-sm-9">
    <p>{!! $status[$pemesanan->status] !!}</p>
  </div>
</div>

<!-- User Id Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('user_id', 'Pegawai') !!}
  </div>
  <div class="col-sm-9">
    <p>{!! $pemesanan->user->name !!}</p>
  </div>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('created_at', 'Created At') !!}
  </div>
  <div class="col-sm-9">
    <p>{!! $pemesanan->created_at !!}</p>
  </div>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('updated_at', 'Updated At') !!}
  </div>
  <div class="col-sm-9">
    <p>{!! $pemesanan->updated_at !!}</p>
  </div>
</div>
