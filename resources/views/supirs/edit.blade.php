@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Supir
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($supir, ['route' => ['supirs.update', $supir->id], 'method' => 'patch']) !!}

                        @include('supirs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection