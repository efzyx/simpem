<li class="header text-center">MENU</li>
<li class="{{ Request::is('produks*') ? 'active' : '' }}">
    <a href="{!! route('produks.index') !!}"><i class="fa fa-industry"></i><span>Produk</span></a>
</li>

<li class="{{ Request::is('supirs*') ? 'active' : '' }}">
    <a href="{!! route('supirs.index') !!}"><i class="fa fa-truck"></i><span>Supir</span></a>
</li>

<li class="{{ Request::is('pemesanans*') ? 'active' : '' }}">
    <a href="{!! route('pemesanans.index') !!}"><i class="fa fa-calendar"></i><span>Pemesanan</span></a>
</li>

<li class="{{ Request::is('produksis*') ? 'active' : '' }}">
    <a href="{!! route('produksis.index') !!}"><i class="fa fa-flask"></i><span>Produksi</span></a>
</li>

<li class="{{ Request::is('pengiriman*') ? 'active' : '' }}">
    <a href="{!! route('pengiriman.index') !!}"><i class="fa fa-plane"></i><span>Pengiriman</span></a>
</li>

<li class="{{ Request::is('pengadaans*') ? 'active' : '' }}">
    <a href="{!! route('pengadaans.index') !!}"><i class="fa fa-cart-arrow-down"></i><span>Pengadaan</span></a>
</li>

<li class="{{ Request::is('opnames*') ? 'active' : '' }}">
    <a href="{!! route('opnames.index') !!}"><i class="fa fa-search-minus"></i><span>Opname</span></a>
</li>

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-users"></i><span>Pegawai</span></a>
</li>

<li class="treeview {{ Request::is('jabatans*') || Request::is('bahanBakus*') ? 'active' : '' }}">
      <a href="#">
        <i class="fa fa-gear"></i> <span>Konfigurasi</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="{{ Request::is('jabatans*') ? 'active' : '' }}">
                <a href="{!! route('jabatans.index') !!}"><i class="fa fa-circle-o"></i>Jabatan</a>
        </li>
        <li class="{{ Request::is('bahanBakus*') ? 'active' : '' }}">
            <a href="{!! route('bahanBakus.index') !!}"><i class="fa fa-circle-o"></i>Bahan Baku</a>
        </li>
      </ul>
  </li>
<li class="{{ Request::is('bahanBakuHistories*') ? 'active' : '' }}">
    <a href="{!! route('bahanBakuHistories.index') !!}"><i class="fa fa-edit"></i><span>Bahan Baku Histories</span></a>
</li>

