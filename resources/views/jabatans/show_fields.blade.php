<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $jabatan->id !!}</p>
</div>

<!-- Nama Jabatan Field -->
<div class="form-group">
    {!! Form::label('nama_jabatan', 'Nama Jabatan:') !!}
    <p>{!! $jabatan->nama_jabatan !!}</p>
</div>

<!-- Keterangan Field -->
<div class="form-group">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    <p>{!! $jabatan->keterangan !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $jabatan->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $jabatan->updated_at !!}</p>
</div>

