<li class="{{ Request::is('produks*') ? 'active' : '' }}">
    <a href="{!! route('produks.index') !!}"><i class="fa fa-edit"></i><span>Produks</span></a>
</li>

<li class="{{ Request::is('pemesanans*') ? 'active' : '' }}">
    <a href="{!! route('pemesanans.index') !!}"><i class="fa fa-edit"></i><span>Pemesanans</span></a>
</li>

