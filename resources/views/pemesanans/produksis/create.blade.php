@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Tambah Produksi untuk <strong>{{ $pemesanan->nama_pemesanan }}</strong>
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => ['pemesanans.produksis.store', $pemesanan]]) !!}

                        @include('pemesanans.produksis.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
  <script type="text/javascript">
              $(function () {
                  $('.datetimepicker').datetimepicker({
                    format: "YYYY-MM-DD HH:mm:ss"
                  });
              });
  </script>
@endsection
