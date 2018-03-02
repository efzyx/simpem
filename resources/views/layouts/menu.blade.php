<li class="{{ Request::is('produks*') ? 'active' : '' }}">
    <a href="{!! route('produks.index') !!}"><i class="fa fa-edit"></i><span>Produks</span></a>
</li>

<li class="{{ Request::is('jabatans*') ? 'active' : '' }}">
    <a href="{!! route('jabatans.index') !!}"><i class="fa fa-edit"></i><span>Jabatans</span></a>
</li>


<li class="{{ Request::is('supirs*') ? 'active' : '' }}">
    <a href="{!! route('supirs.index') !!}"><i class="fa fa-edit"></i><span>Supirs</span></a>
</li>

<li class="{{ Request::is('pemesanans*') ? 'active' : '' }}">
    <a href="{!! route('pemesanans.index') !!}"><i class="fa fa-edit"></i><span>Pemesanans</span></a>
</li>

<li class="{{ Request::is('produksis*') ? 'active' : '' }}">
    <a href="{!! route('produksis.index') !!}"><i class="fa fa-edit"></i><span>Produksis</span></a>
</li>

<li class="{{ Request::is('pengiriman*') ? 'active' : '' }}">
    <a href="{!! route('pengiriman.index') !!}"><i class="fa fa-edit"></i><span>Pengiriman</span></a>
</li>

<li class="{{ Request::is('bahanBakus*') ? 'active' : '' }}">
    <a href="{!! route('bahanBakus.index') !!}"><i class="fa fa-edit"></i><span>Bahan Bakus</span></a>
</li>

<li class="{{ Request::is('pengadaans*') ? 'active' : '' }}">
    <a href="{!! route('pengadaans.index') !!}"><i class="fa fa-edit"></i><span>Pengadaans</span></a>
</li>

<li class="{{ Request::is('opnames*') ? 'active' : '' }}">
    <a href="{!! route('opnames.index') !!}"><i class="fa fa-edit"></i><span>Opnames</span></a>
</li>
