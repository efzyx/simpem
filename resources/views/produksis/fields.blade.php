<!-- Pemesanan Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('pemesanan_id', 'Pemesanan') !!}
    {!! Form::select('pemesanan_id', $pemesanans, null, ['class' => 'form-control']) !!}
</div>

<!-- Volume Field -->
<div class="form-group col-sm-12">
    {!! Form::label('volume', 'Volume:') !!}
    {!! Form::number('volume', null, ['class' => 'form-control']) !!}
</div>

<!-- Waktu Produksi Field -->
<div class="form-group col-sm-12">
    {!! Form::label('waktu_produksi', 'Waktu Produksi:') !!}
    {{-- <div class='input-group date' > --}}
        {!! Form::text('waktu_produksi', null, ['class' => 'form-control', 'id'=>'calendar'])!!}
            {{-- <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span> --}}
    {{-- </div> --}}
</div>

<!-- Supir Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('supir_id', 'Supir') !!}
    {!! Form::select('supir_id', $supirs , null, ['class' => 'form-control']) !!}
</div>

<!-- No Kendaraan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('no_kendaraan', 'No Kendaraan') !!}
    {!! Form::text('no_kendaraan', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('produksis.index') !!}" class="btn btn-default">Cancel</a>
</div>
