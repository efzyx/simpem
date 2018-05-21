@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Material Keluar Diluar Produksi</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('opnames.create') !!}">Tambah Baru</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#filter"><i class="fa fa-filter"></i> Filter</button>
        <br><br>
        <div id="filter" class="collapse">
          <div class="box box-solid box-primary">
            <div class="box-header">
              <h3 class="box-title">Filter</h3>
            </div>
            <div class="box-body">
              {!! Form::open(['route' => ['filterOpname']]) !!}
                  @include('opnames.filter_fields')
              {!! Form::close() !!}
            </div>
          </div>
        </div>
        <div class="box box-solid box-primary">
          <div class="box-header">
            <h3 class="box-title">Rekapitulasi Material Keluar</h3>
          </div>
            <div class="box-body">
              <h1 class="pull-left">
                   {!! Form::open(['route' => 'downloadOpname' , 'target' => '_blank'])!!}
                    {!! Form::hidden('opnames', $opnames) !!}
                    {!! Form::submit('Download', ['class' => 'btn btn-danger pull-left', 'style' => 'margin-top: -10px;margin-bottom: 5px']) !!}
                   {!! Form::close() !!}
              </h1>
              <div class="clearfix">
              </div>
              <div class="table-responsive">
                    @include('opnames.table')
              </div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    $('#opnames-table').DataTable();
  });
</script>
@endsection
