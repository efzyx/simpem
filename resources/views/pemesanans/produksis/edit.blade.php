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
                   {!! Form::model($produksi, ['route' => ['pemesanans.produksis.update', $pemesanan, $produksi->id], 'method' => 'patch']) !!}

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
                    // locale : 'id'
                    format: "YYYY-MM-DD HH:mm:ss"
                  });
              });
  </script>
@endsection