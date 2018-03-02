@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pengadaan
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
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