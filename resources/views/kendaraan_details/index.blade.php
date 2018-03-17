@extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1 class="pull-left">
         <a class="btn btn-default pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('kendaraans.index') !!}">List Kendaraan</a>
      </h1>
      <h1 class="pull-right">
         <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('kendaraans.kendaraanDetails.create', $kendaraan) !!}">Add New</a>
      </h1>
      <hr>
        <h1 class="pull-left">List Status Kendaraan <strong>{{ $kendaraan->jenis_kendaraan }} ({{ $kendaraan->no_polisi }})</strong></h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('kendaraan_details.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection
