@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Batas Pengadaan</h1>
        <br>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-solid box-primary">
          <div class="box-header">
            <h3 class="box-title">Pengaturan Batas Pengadaan</h3>
          </div>
            <div class="box-body">
              <div class="table-responsive">
                @include('batas_pengadaans.table')
              </div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection
