<!-- Id Field -->
<div class="form-group col-sm-12">
    <div class="col-sm-3">
    {!! Form::label('id', 'Id:') !!}
  </div>
  <div class="col-sm-9">
    {!! $pengadaan->id !!}
  </div>
</div>

<!-- Bahan Baku Id Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('bahan_baku_id', 'Bahan Baku Id:') !!}
  </div>
  <div class="sol-sm-9">
    {!! $pengadaan->bahan_baku->nama_bahan_baku !!}
  </div>
</div>

<!-- Berat Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('berat', 'Berat:') !!}
  </div>
  <div class="sol-sm-9">
    {!! $pengadaan->berat !!}
  </div>
</div>

<!-- Supplier Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('supplier', 'Supplier:') !!}
  </div>
  <div class="sol-sm-9">
    {!! $pengadaan->supplier !!}
  </div>
</div>

<!-- Tanggal Pengadaan Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('tanggal_pengadaan', 'Tanggal Pengadaan:') !!}
  </div>
  <div class="sol-sm-9">
    {!! $pengadaan->tanggal_pengadaan !!}
  </div>
</div>

<!-- User Id Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('user_id', 'User Id:') !!}
  </div>
  <div class="sol-sm-9">
    {!! $pengadaan->user->name !!}
  </div>
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('keterangan', 'Keterangan:') !!}
  </div>
  <div class="sol-sm-9">
    {!! $pengadaan->keterangan !!}
  </div>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('created_at', 'Created At:') !!}
  </div>
  <div class="sol-sm-9">
    {!! $pengadaan->created_at !!}
  </div>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-12">
  <div class="col-sm-3">
    {!! Form::label('updated_at', 'Updated At:') !!}
  </div>
  <div class="sol-sm-9">
    {!! $pengadaan->updated_at !!}
  </div>
</div>
