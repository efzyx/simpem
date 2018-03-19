@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Opname
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

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
