@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pengadaan <small>Tambah</small>
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-solid box-primary">
          <div class="box-header">
            <h3 class="box-title">Form Tambah Pengadaan</h3>
          </div>

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'pengadaans.store']) !!}

                        @include('pengadaans.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
  <script type="text/javascript">
              $(function () {
                  $('#calendar1').datetimepicker({
                    format: "YYYY-MM-DD HH:mm:ss"
                  });
              });
  </script>
@endsection
