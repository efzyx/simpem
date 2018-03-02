@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pengiriman
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($pengiriman, ['route' => ['pengiriman.update', $pengiriman->id], 'method' => 'patch']) !!}

                        @include('pengiriman.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection