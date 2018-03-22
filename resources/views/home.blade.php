@extends('layouts.app')

@section('content')
  <div class="card-header">
    <section class="content-header">
    <h1>
      Beranda
      <small>Dashboard</small>
    </h1>
  </section>
  </div>
  <section class="content">
    <div class="row">
      <div class="col-md-7">
        <div class="box box-solid box-primary">
          <div class="box-header">
            <h3 class="box-title">Status Bahan Baku</h3>
          </div>
          <div class="box-body">
            <div class="row">
              @foreach($bahanBakus as $bahanBaku)
                @php
                  $sisa = $bahanBaku->sisa;
                @endphp
              <div class="col-md-3 col-xs-6">
                <!-- small box -->
                <div class="small-box {{ $sisa < 250 ? 'bg-red' : ($sisa < 500 ? 'bg-yellow' : ($sisa < 1000 ? 'bg-green' : 'bg-aqua')) }}" sty>
                  <div class="inner">
                    <h3>{!! $bahanBaku->sisa !!}</h3>

                    <p>{!! $bahanBaku->satuan !!}</p>
                  </div>
                  <a href="#" class="small-box-footer">{!! $bahanBaku->nama_bahan_baku !!}</i></a>
                </div>
              </div>
              @endforeach
            </div>
          </div>

        </div>
      </div>
      <div class="col-md-5">
        <div class="box box-solid bg-green-gradient">
          <div class="box-header">
            <i class="fa fa-calendar"></i>
            <h3 class="box-title">Kalender</h3>
          </div>
          <div class="box-body no-padding">
            <div id="calendar" style="width: 100%"></div>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="box box-solid box-info">
          <div class="box-header">
            <i class="fa fa-product-hunt"></i>
            <h3 class="box-title">Produk</h3>
          </div>
          <div class="box-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Mutu Produk</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($produks as $key => $produk)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $produk->mutu_produk }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

@section('scripts')
  <script>
    $(function () {
      $('#calendar').datepicker({
        "setDate": new Date(),
        "autoclose": true,
        "todayBtn": true,
        "todayHighlight": true
      })
    })
</script>
@endsection
