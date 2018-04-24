@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">List Produksi untuk <strong>{{ $pemesanan->nama_pemesanan }}</strong></h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('pemesanans.produksis.create', $pemesanan) !!}">Tambah Baru</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-solid box-primary">
          <div class="box-header">
            <h3 class="box-title">List Produksi</h3>
          </div>
            <div class="box-body">
              <div class="table-responsive">
                <h1 class="pull-left">
                      {!! Form::open(['route' => 'downloadPengiriman' , 'target' => '_blank'])!!}
                      {!! Form::hidden('pemesanans', $pemesanan) !!}
                      {!! Form::submit('Download', ['class' => 'btn btn-danger pull-left', 'style' => 'margin-top: -10px;margin-bottom: 5px']) !!}
                      {!! Form::close() !!}
                </h1>
                @include('pemesanans.produksis.table')
              </div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

@section('scripts')
  <script type="text/javascript">
    $(document).ready(function() {
      setTimeout(function(){
        $('#produksis-table').DataTable();
        $('.status').on('change', function() {
          $(this.form).trigger('submit')
        });
      }, 1000);
    });
  </script>
@endsection
