<!-- Pemesanan Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pemesanan_id', 'Pemesanan Id:') !!}
    {!! Form::text('pemesanan_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Volume Field -->
<div class="form-group col-sm-6">
    {!! Form::label('volume', 'Volume:') !!}
    {!! Form::number('volume', null, ['class' => 'form-control']) !!}
</div>

<!-- Semen Field -->
<div class="form-group col-sm-6">
    {!! Form::label('semen', 'Semen:') !!}
    {!! Form::number('semen', null, ['class' => 'form-control']) !!}
</div>

<!-- Pasir Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pasir', 'Pasir:') !!}
    {!! Form::number('pasir', null, ['class' => 'form-control']) !!}
</div>

<!-- Split Field -->
<div class="form-group col-sm-6">
    {!! Form::label('split', 'Split:') !!}
    {!! Form::number('split', null, ['class' => 'form-control']) !!}
</div>

<!-- Addictive Field -->
<div class="form-group col-sm-6">
    {!! Form::label('addictive', 'Addictive:') !!}
    {!! Form::number('addictive', null, ['class' => 'form-control']) !!}
</div>

<!-- Air Field -->
<div class="form-group col-sm-6">
    {!! Form::label('air', 'Air:') !!}
    {!! Form::number('air', null, ['class' => 'form-control']) !!}
</div>

<!-- Waktu Produksi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('waktu_produksi', 'Waktu Produksi:') !!}
    {!! Form::date('waktu_produksi', null, ['class' => 'form-control']) !!}
</div>

<!-- Supir Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('supir_id', 'Supir Id:') !!}
    {!! Form::text('supir_id', null, ['class' => 'form-control']) !!}
</div>

<!-- No Kendaraan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_kendaraan', 'No Kendaraan:') !!}
    {!! Form::text('no_kendaraan', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('produksis.index') !!}" class="btn btn-default">Cancel</a>
</div>
