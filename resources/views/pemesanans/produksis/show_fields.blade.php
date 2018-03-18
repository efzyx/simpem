<!-- Id Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('id', 'ID') !!}
  </div>
  <div class="col-sm-9">
    <p>{!! $produksi->id !!}</p>
  </div>
</div>

<!-- Pemesanan Id Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('pemesanan_id', 'Nama Pemesanan') !!}
  </div>
  <div class="col-sm-9">
    <p>{!! $produksi->pemesanan->nama_pemesanan !!}</p>
  </div>
</div>

<!-- Volume Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('volume', 'Volume') !!}
  </div>
  <div class="col-sm-9">
    <p>{!! $produksi->volume !!}</p>
  </div>
</div>

<!-- Waktu Produksi Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('waktu_produksi', 'Waktu Produksi') !!}
  </div>
  <div class="col-sm-9">
    <p>{!! $produksi->waktu_produksi !!}</p>
  </div>
</div>

<!-- Supir Id Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('supir_id', 'Supir') !!}
  </div>
  <div class="col-sm-9">
    <p>{!! $produksi->supir->nama_supir !!}</p>
  </div>
</div>

<!-- No Kendaraan Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('no_kendaraan', 'Nomor Polisi') !!}
  </div>
  <div class="col-sm-9">
    <p>{!! $produksi->kendaraan->no_polisi !!}</p>
  </div>
</div>

@php
  $status = [
    'Sedang Produksi',
    'Sedang Dikirim',
    'Terkirim'
  ];
@endphp
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('', 'Satus') !!}
  </div>
  <div class="col-sm-9">
    <p><a href="{{ route('pemesanans.produksis.pengiriman.index', [$produksi->pemesanan, $produksi]) }}">{!! $status[$produksi->pengirimans->last()->status] !!}</a></p>
  </div>
</div>

<!-- User Id Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('user_id', 'Pegawai') !!}
  </div>
  <div class="col-sm-9">
    <p>{!! $produksi->user->name !!}</p>
  </div>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('created_at', 'Created At') !!}
  </div>
  <div class="col-sm-9">
    <p>{!! $produksi->created_at !!}</p>
  </div>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('updated_at', 'Updated At') !!}
  </div>
  <div class="col-sm-9">
    <p>{!! $produksi->updated_at !!}</p>
  </div>
</div>
