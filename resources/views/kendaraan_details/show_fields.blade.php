<!-- Kendaraan Id Field -->
<div class="form-group col-sm-12">
    <div class="col-sm-3">
    {!! Form::label('kendaran_id', 'Kendaraan:') !!}
  </div>
  <div class="col-sm-9">
    {!! $kendaraanDetail->kendaraan->jenis_kendaraan !!}
  </div>
</div>


<!-- Status Field -->
<div class="form-group col-sm-12">
    <div class="col-sm-3">
    {!! Form::label('status', 'Status:') !!}
  </div>
  <div class="col-sm-9">
    {!! $stt[$kendaraanDetail->status] !!}
  </div>
</div>


<!-- Waktu Field -->
<div class="form-group col-sm-12">
    <div class="col-sm-3">
    {!! Form::label('waktu', 'Waktu:') !!}
  </div>
  <div class="col-sm-9">
    {!! $kendaraanDetail->waktu !!}
  </div>
</div>


<!-- Created At Field -->
<div class="form-group col-sm-12">
    <div class="col-sm-3">
    {!! Form::label('created_at', 'Created At:') !!}
  </div>
  <div class="col-sm-9">
    {!! $kendaraanDetail->created_at !!}
  </div>
</div>


<!-- Updated At Field -->
<div class="form-group col-sm-12">
    <div class="col-sm-3">
    {!! Form::label('updated_at', 'Updated At:') !!}
  </div>
  <div class="col-sm-9">
    {!! $kendaraanDetail->updated_at !!}
  </div>
</div>
