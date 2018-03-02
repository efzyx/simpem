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
                   {!! Form::model($opname, ['route' => ['opnames.update', $opname->id], 'method' => 'patch']) !!}

                        @include('opnames.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection