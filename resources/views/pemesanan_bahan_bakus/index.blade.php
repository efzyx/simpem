@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Pemesanan Bahan Bakus</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('pemesananBahanBakus.create') !!}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('pemesanan_bahan_bakus.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection @section('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#pemesananBahanBakus-table').DataTable();
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
