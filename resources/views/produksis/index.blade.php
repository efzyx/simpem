@extends('layouts.app') @section('content')
<section class="content-header">
  <h1 class="pull-left">Produksi</h1>

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
        <div class="table-responsive">
        {!! Form::open(['route' => 'produksis.filter']) !!}

            @include('produksis.filter_fields')

        {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="box box-solid box-primary">
    <div class="box-header">
      <h3 class="box-title">List Produksi</h3>
    </div>
    <div class="box-body">
      <h1 class="pull-left">
            {!! Form::open(['route' => 'downloadProduksiPdf' , 'target' => '_blank'])!!}
            {!! Form::hidden('produksis', $produksis) !!}
            {!! Form::submit('Download', ['class' => 'btn btn-danger pull-left', 'style' => 'margin-top: -10px;margin-bottom: 5px']) !!}
            </h1>
      <h1 class="pull-right">
               <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('produksis.create') !!}">Add New</a>
            </h1>
          <br><br><hr>

        @include('produksis.table')

    </div>
  </div>
  <div class="text-center">

  </div>
</div>
@endsection @section('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    $('#produksis-table').DataTable();
    $('select').on('change', function() {
      $(this.form).trigger('submit')
    });
  });
</script>
@endsection
