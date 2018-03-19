@extends('layouts.app')
@php
  // dd(request())
@endphp
@section('content')
    <section class="content-header">
        <h1 class="pull-left">List Produksi untuk <strong>{{ $pemesanan->nama_pemesanan }}</strong></h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('pemesanans.produksis.create', $pemesanan) !!}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
              <div class="table-responsive">
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
    $('#produksis-table').DataTable();
    $('select').on('change',function() {
      $(this.form).trigger('submit')
    });
  });
  </script>
@endsection
