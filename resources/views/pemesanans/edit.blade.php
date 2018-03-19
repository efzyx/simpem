@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pemesanan
        </h1>
   </section>
   <div class="content">
     <div class="clearfix"></div>

     @include('flash::message')

     <div class="clearfix"></div>
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($pemesanan, ['route' => ['pemesanans.update', $pemesanan->id], 'method' => 'patch']) !!}

                        @include('pemesanans.fields')

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
                    // locale : 'id'
                    format: "YYYY-MM-DD HH:mm:ss"
                  });
                  $('#calendar2').datetimepicker({
                    // locale : 'id'
                    format: "YYYY-MM-DD HH:mm:ss"
                  });
              });
  </script>
@endsection
