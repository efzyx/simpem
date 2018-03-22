@extends('layouts.app') @section('content')
<section class="content-header">
  <h1 class="pull-left">Pemesanan</h1>
  <br><br><br>
  <h1 class="pull-left">
           <a class="btn btn-danger pull-left" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('downloadPdf') !!}" target="_blank"><i class="fa fa-file"></i> Download</a>
        </h1>
  <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('pemesanans.create') !!}">Add New</a>
        </h1>
</section>
<div class="content">
  <div class="clearfix"></div>

  @include('flash::message')

  <div class="clearfix"></div>
  <div class="box box-solid box-primary">
    <div class="box-header">
      <h3 class="box-title">List Pemesanan</h3>
    </div>
    <div class="box-body">
      @include('pemesanans.table')
    </div>
  </div>
  <div class="text-center">

  </div>
</div>
@endsection @section('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#pemesanans-table').DataTable();
    // Apply the search
    table.columns().every(function() {
      var that = this;

      $('input', this.footer()).on('keyup change', function() {
        if (that.search() !== this.value) {
          that
            .search(this.value)
            .draw();
        }
      });
    });
  });
</script>
@endsection
