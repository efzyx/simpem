@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Bahan Baku <small>Tambah</small>
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-solid box-primary">
          <div class="box-header">
            <h3 class="box-title">Form Tambah Bahan Baku</h3>
          </div>

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'bahanBakus.store']) !!}

                        @include('bahan_bakus.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
