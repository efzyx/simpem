@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Riwayat Bahan Baku</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('bahan_baku_histories.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

@section('scripts')

  <script type="text/javascript">
  $(document).ready(function() {
    var table = $('#bahanBakuHistories-table').DataTable({
      responsive: true,
    });
    new $.fn.dataTable.FixedHeader(table);
  });
  </script>

@endsection
