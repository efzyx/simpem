@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Penerimaan Material <strong>{{$supplier->bahan_baku->nama_bahan_baku}}</strong> dari <strong>{{ $supplier->nama_supplier}}</strong></h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('supplier.pengadaans.create', $supplier) !!}">Tambah Baru</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-solid box-primary">
          <div class="box-header">
            <h3 class="box-title">Rekapitulasi Penerimaan Material</h3>
          </div>
            <div class="box-body">
              <h1 class="pull-left">
                   {!! Form::open(['route' => 'downloadPengadaan' , 'target' => '_blank'])!!}
                    {!! Form::hidden('supplier', $supplier) !!}
                    {!! Form::submit('Download', ['class' => 'btn btn-danger pull-left', 'style' => 'margin-top: -10px;margin-bottom: 5px']) !!}
              </h1>
                  @include('pemesanan_bahan_bakus.pengadaans.table')

            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    $('#pengadaans-table').DataTable();
  });
</script>
@endsection
