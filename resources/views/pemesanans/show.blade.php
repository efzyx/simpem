@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pemesanan <small>Show</small>
        </h1>
    </section>
    <div class="content">
      <div class="box box-solid box-primary">
        <div class="box-header">
          <h3 class="box-title">Detail Pemesanan {{ $pemesanan->nama_pemesanan }}</h3>
        </div>
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('pemesanans.show_fields')
                    <a href="{!! route('pemesanans.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
