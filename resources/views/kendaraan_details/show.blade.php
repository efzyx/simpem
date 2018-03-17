@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Detail Status Kendaraan {{ $kendaraan->jenis_kendaraan }} ({{ $kendaraan->no_polisi }})
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('kendaraan_details.show_fields')
                    <a href="{!! route('kendaraans.kendaraanDetails.index', $kendaraan) !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
