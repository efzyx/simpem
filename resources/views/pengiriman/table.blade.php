<table class="table table-responsive" id="pengiriman-table">
    <thead>
        <tr>
            <th>Produksi Id</th>
        <th>Status</th>
        <th>User Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($pengiriman as $pengiriman)
        <tr>
            <td>{!! $pengiriman->produksi_id !!}</td>
            <td>{!! $pengiriman->status !!}</td>
            <td>{!! $pengiriman->user_id !!}</td>
            <td>
                {!! Form::open(['route' => ['pengiriman.destroy', $pengiriman->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('pengiriman.show', [$pengiriman->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('pengiriman.edit', [$pengiriman->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>