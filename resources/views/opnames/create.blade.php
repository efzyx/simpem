@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Opname <small>Tambah</small>
        </h1>
    </section>
    <div class="content">
      <div class="clearfix"></div>

      @include('flash::message')

      <div class="clearfix"></div>
        @include('adminlte-templates::common.errors')
        <div class="box box-solid box-primary">
          <div class="box-header">
            <h3 class="box-title">Form Tambah Opname</h3>
          </div>

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'opnames.store']) !!}

                        @include('opnames.fields')

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
