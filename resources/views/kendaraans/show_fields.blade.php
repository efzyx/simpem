<!-- Id Field -->
<div class="form-group col-sm-12">
    <div class="col-sm-3">
    {!! Form::label('id', 'Id:') !!}
  </div>
  <div class="col-sm-9">
    {!! $kendaraan->id !!}
  </div>
</div>

<!-- Jenis Kendaraan Field -->
<div class="form-group col-sm-12">
    <div class="col-sm-3">
    {!! Form::label('jenis_kendaraan', 'Jenis Kendaraan:') !!}
  </div>
  <div class="col-sm-9">
    {!! $kendaraan->jenis_kendaraan !!}
  </div>
</div>

<!-- No Polisi Field -->
<div class="form-group col-sm-12">
    <div class="col-sm-3">
    {!! Form::label('no_polisi', 'No Polisi:') !!}
  </div>
  <div class="col-sm-9">
    {!! $kendaraan->no_polisi !!}
  </div>
</div>


<!-- Created At Field -->
<div class="form-group col-sm-12">
    <div class="col-sm-3">
    {!! Form::label('created_at', 'Created At:') !!}
  </div>
  <div class="col-sm-9">
    {!! $kendaraan->created_at !!}
  </div>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-12">
    <div class="col-sm-3">
    {!! Form::label('updated_at', 'Updated At:') !!}
  </div>
  <div class="col-sm-9">
    {!! $kendaraan->updated_at !!}
  </div>
</div>
