<table class="table" id="batasPengadaans-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Bahan Baku</th>
        <th>Maks Pengadaan</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
      @php
        $no = 1;
      @endphp
    @foreach($bahanBakus as $bahanBaku)
        <tr>{!! Form::open(['route' => ['batasPengadaans.store']]) !!}
            <td>{{ $no++ }}</td>
            <td>{!! $bahanBaku->nama_bahan_baku !!}</td>
            <td>
              <div class="col-sm-6">
                {!! Form::hidden('bahan_baku_id', $bahanBaku->id) !!}
                {!! Form::number('maks_pengadaan', $bahanBaku->batas_pengadaan ? $bahanBaku->batas_pengadaan->maks_pengadaan : null, ['class' => 'form-control', 'placeholder' => 'Belum diset'])!!}
              </div>
              <div class="col-sm-6">
                <p>{{ $bahanBaku->satuan }}</p>
              </div>
            </td>
            <td>
                <div class='btn-group'>
                    {!! Form::button('Simpan', ['type' => 'submit', 'class' => 'btn btn-primary', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>

            </td>
            {!! Form::close() !!}
        </tr>
    @endforeach
    </tbody>
</table>
