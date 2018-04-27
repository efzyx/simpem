
<!-- Keterangan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('', 'Rentang Tanggal:') !!}
    <div class="">
      <div class="col-sm-6">
        {!! Form::date('tanggal_kirim_dari', null, ['class' => 'form-control', 'placeholder' => 'Dari']) !!}
      </div>
      <div class="col-sm-6">
        {!! Form::date('tanggal_kirim_sampai', null, ['class' => 'form-control', 'placeholder' => 'Sampai']) !!}
      </div>
    </div>
</div>

<div class="form-group col-sm-6">
  {!! Form::label('bahan_baku', 'Bahan Baku:') !!}
  {!! Form::select('bahan_baku', ['1' => 'Semen','2'=>'Air','3'=>'Pasir','4'=>'Split','5'=>'Addictive'], null, ['class' => 'form-control', 'placeholder' => '- Pilih Bahan Baku -'])!!}
</div>
<div class="form-group col-sm-6">
  {!! Form::label('jenis_kegiatan', 'Jenis Kegiatan:') !!}
  {!! Form::select('jenis_kegiatan', ['0' => 'Produksi','1'=>'Opname','2'=>'Pengadaan'], null, ['class' => 'form-control', 'placeholder' => '- Pilih Jenis Kegiatan -'])!!}
</div>

<div class="form-group col-sm-12">
    {!! Form::submit('Cari', ['class' => 'btn btn-primary']) !!}
</div>