@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Produksi
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'produksis.store']) !!}

                        @include('produksis.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
  <script type="text/javascript">
              $(function () {
                  $('#calendar').datetimepicker({
                    // locale : 'id'
                    format: "YYYY-MM-DD HH:mm:ss"
                  });
              });
  </script>
@endsection
