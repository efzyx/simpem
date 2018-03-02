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
                   {!! Form::model($produksi, ['route' => ['produksis.update', $produksi->id], 'method' => 'patch']) !!}

                        @include('produksis.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection