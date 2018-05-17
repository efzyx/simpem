@extends('layouts.app')


@section('content')
    <section class="content-header">
        <h1>
            Penerimaan Material <small>Tambah</small>
        </h1>
    </section>
    <div class="content">
       <div class="clearfix"></div>

       @include('flash::message')

       <div class="clearfix"></div>
        @include('adminlte-templates::common.errors')
        <div class="box box-solid box-primary">
          <div class="box-header">
            <h3 class="box-title">Form Tambah Penerimaan Material</h3>
          </div>

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'pengadaans.store']) !!}

                        @include('pengadaans.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
