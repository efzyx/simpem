@extends('layouts.app')

@section('content')
<div class="container">

  <section class="content-header">
  <h1>
    Welcome
    <small>Informasi Bahan Baku</small>
  </h1>
</section>

    <div class="row">

      <div class="row">
        @foreach($bahanBakus as $bahanBaku)

        <div class="col-lg-2 col-xs-5">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{!! $bahanBaku->sisa !!}</h3>

              <p>{!! $bahanBaku->nama_bahan_baku !!}</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Information</i></a>
          </div>
        </div>


        @endforeach

        <!-- ./col -->
      </div>
    </div>

  </div>

@endsection
