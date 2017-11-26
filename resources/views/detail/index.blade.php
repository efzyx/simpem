@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Pemesanan Produk</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
              <div class="box-body">
                  <div class="row">
                      {!! Form::open(['route' => array('storePesanan', $pemesanan_id)]) !!}

                          @include('detail.fields')

                      {!! Form::close() !!}
                  </div>
              </div>
                    @include('detail.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection
