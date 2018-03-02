@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Produk
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($produk, ['route' => ['produks.update', $produk->id], 'method' => 'patch']) !!}

                        @include('produks.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection