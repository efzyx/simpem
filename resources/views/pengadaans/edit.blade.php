@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pengadaan <small>Edit</small>
        </h1>
   </section>
   <div class="content">
     <div class="clearfix"></div>

     @include('flash::message')

     <div class="clearfix"></div>
       @include('adminlte-templates::common.errors')
       <div class="box box-solid box-primary">
         <div class="box-header">
           <h3 class="box-title">Form Edit Pengadaan</h3>
         </div>
           <div class="box-body">
               <div class="row">
                   {!! Form::model($pengadaan, ['route' => ['pengadaans.update', $pengadaan->id], 'method' => 'patch']) !!}

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
