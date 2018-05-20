<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cetak Rekapitulasi Material</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>
      <h1 class="text-center">Rekapitulasi Material</h1>
      <br><br>
      @php
      $thistory = [];
      $bahan = \App\Models\BahanBaku::select('id','nama_bahan_baku','satuan')->get();
      $b = count($bahan);
      $a = 0;
      foreach($bahan as $bhn){
        $thistory[$bhn->id] = 1;
      }
      @endphp
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Material</th>
              <th>Satuan</th>
              <th>Stock</th>
              <th>Masuk</th>
              <th>Keluar</th>
              <th>Jumlah</th>
            </tr>
          </thead>
          @php
          $no = 1;
          $k = 0;

          @endphp
          <tbody>
            @foreach($bahan as $bhn)
            $bhn->bahan_baku_histories()->where('bahan_baku_id','=',$bhn->id);
            

            @endforeach
          @foreach ($bahanBakuHistories as $bahanBakuHistory)

                @if($k=0 || $k != $bahanBakuHistory->created_at->format('j F Y'))
                  $k = $bahanBakuHistory->created_at->format('j F Y');
                @php
                $stock = App\Models\BahanBakuHistory::where('created_at','<=', $bahanBakuHistory->created_at)
                                                    ->where('created_at','>=',$bahanBakuHistory->created_at->subDays(1)->startOfDay())
                                                    ->where('bahan_baku_id','=',$bahanBakuHistory->bahan_baku_id)
                                                    ->first();
                $masuk1 = App\Models\BahanBakuHistory::where('created_at','<=',$bahanBakuHistory->created_at)
                                                    ->where('created_at','>=',$bahanBakuHistory->created_at->subDays(1)->startOfDay())
                                                    ->where('bahan_baku_id','=',$bahanBakuHistory->bahan_baku_id)
                                                    ->where('type','=','2')
                                                    ->sum('volume');
                $keluar = App\Models\BahanBakuHistory::where('created_at','<=', $bahanBakuHistory->created_at)
                                                    ->where('created_at','>=',$bahanBakuHistory->created_at->subDays(1)->startOfDay())
                                                    ->where('bahan_baku_id','=',$bahanBakuHistory->bahan_baku_id)
                                                    ->where('type','=','0')
                                                    ->orWhere('type','=','1')
                                                    ->sum('volume');
                @endphp
                <tr>
                  <td colspan="6">{{$bahanBakuHistory->created_at->format('j F Y')}}</td>
                </tr>
                <tr>
                <td>{{$no++}}</td>
                <td>{{$bahanBakuHistory->bahan_baku->nama_bahan_baku}}</td>
                <td>{{$bahanBakuHistory->bahan_baku->satuan}}</td>
                <td>{{$stock->total_sisa}}</td>
                <td>{{$masuk1}}</td>
                <td>{{$keluar}}</td>
                <td>{{$stock->total_sisa + $masuk1 - $keluar }}</td>
              </tr>
              @endif
        @endforeach

        </tbody>
      </table>

      <br><br>

      <div class="pull-right">
           Padang, {{date("d-m-Y")}}
            <br>
           Dibuat Oleh
            <br><br><br><br>
           {{$user}}
      </div>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
</html>
