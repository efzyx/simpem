@extends('layouts.app') @section('content')
<section class="content-header">
  <h1 class="pull-left">Riwayat Material</h1>
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
        {!! Form::open(['route' => 'filterHistoryBahanBaku']) !!}
            @include('bahan_baku_histories.filter_fields')
        {!! Form::close() !!}
      </div>
    </div>
  </div>
  <div class="box box-solid box-primary">
    <div class="box-header">
      <h3 class="box-title">List Riwayat</h3>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        @include('bahan_baku_histories.table')
      </div>
    </div>
  </div>
  <div class="text-center">

  </div>
</div>
@endsection @section('scripts')

<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#bahanBakuHistories-table').DataTable();
  });
</script>

@endsection
