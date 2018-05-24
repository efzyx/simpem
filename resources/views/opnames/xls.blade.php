<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Pemakaian Material non-Produksi</title>
    {{-- <link rel="stylesheet" href={{ asset('css/bootstrap.min.css') }}> --}}
  </head>
  <body>
      <strong>Rekapitulasi Pemakaian Material diluar Produksi</strong>
      <br><br>
      <table>
          <thead>
              <tr>
              <th>No</th>
              <th>Material</th>
              <th>Volume</th>
              <th>Tanggal Pemakaian</th>
              <th>Keterangan</th>
              </tr>
          </thead>
          <tbody>
            @php
              $no = 1;
            @endphp
          @foreach($opnames as $opname)
              <tr>
                  <td>{!! $no++ !!}</td>
                  <td>{!! $opname->bahan_baku->nama_bahan_baku !!}</td>
                  <td>{!! $opname->volume_opname !!}</td>
                  <td>{!! $opname->tanggal_pemakaian !!}</td>
                  <td>{!! $opname->keterangan !!}</td>
              </tr>
          @endforeach
          </tbody>
      </table>
        </tbody>

      </table>
      <br><br>
      {{-- <script src="{{ asset('js/jquery.min.js') }}"></script>
      <script src="{{ asset('js/bootstrap.min.js') }}"></script> --}}
  </body>
</html>
