@extends('layouts.app')

@section('content')
    <section class="content-header">
      <div class="btn-toolbar">
        <a class="btn btn-default" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('pemesanans.produksis.index', $produksi->pemesanan, $produksi) !!}"><i class="fa fa-list"></i> Produksi dari {{ $produksi->pemesanan->nama_pemesanan }}</a>
        <a class="btn btn-default" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('pemesanans.index') !!}"><i class="fa fa-list"></i> List Pemesanan</a>
        <a class="btn btn-default" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('produksis.index') !!}"><i class="fa fa-list"></i> List Produksi</a>
      </div>
        <h1 class="pull-left">Riwayat Status Pengiriman <strong>{{ $produksi->kendaraan->no_polisi }} - {{ $produksi->pemesanan->nama_pemesanan }}</strong> </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-solid box-primary">
          <div class="box-header">
            <h3 class="box-title">List Riwayat Pengiriman</h3>
          </div>
            <div class="box-body">
                    @include('pengiriman.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection
