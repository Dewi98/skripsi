<!-- Sidebar Menu -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">NAVIGASI UTAMA</li>
    <!-- Optionally, you can add icons to the links -->
    <li><a href="{{ route('beranda_admin') }}"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
    <li><a href="{{ route('list_produk') }}"><i class="fa fa-cubes"></i> <span>Produk <span class="label bg-primary pull-right" id="jml_produk"></span></span></a></li>
    <li><a href="{{ route('kategori_produk') }}"><i class="fa fa-clipboard"></i> <span>Kategori <span class="label bg-primary pull-right" id="jml_kategori"></span></span></a></li>
    <li><a href="{{ route('merk_produk') }}"><i class="fa fa-tags"></i> <span>Merk <span class="label bg-primary pull-right" id="jml_merk"></span></span></a></li>
    <li><a href="{{ url('admin/resep') }}"><i class="fa fa-tags"></i> <span>Resep <span class="label bg-primary pull-right" id="jml_resep"></span></span></a></li>
    @if (session('superadmin') == true)
    <li><a href="{{ route('superadmin_pengguna') }}"><i class="fa fa-users"></i> <span>Pengguna <span class="label bg-purple pull-right" id="jml_pengguna"></span></span></a></li>
    <li><a href="{{ route('superadmin_admin') }}"><i class="fa fa-users"></i> <span>Admin <span class="label bg-purple pull-right" id="jml_admin"></span></span></a></li>
    @endif
    <li class="header">TRANSAKSI</li>
    <li><a href="{{ route('pembayaran_admin') }}"><i class="fa fa-money"></i> <span>Pembayaran <span class="label bg-red pull-right" id="jml_pembayaran"></span></span></a></li>
    <li><a href="{{ route('pesanan_admin') }}"><i class="fa fa-shopping-cart"></i> <span>Pesanan <span class="label bg-red pull-right" id="jml_pesanan"></span></span></a></li>
    <li><a href="{{ route('pengiriman_admin') }}"><i class="fa fa-truck"></i> <span>Pengiriman <span class="label bg-red pull-right" id="jml_pengiriman"></span></span></a></li>
    <li class="header">LAPORAN</li>
    <li><a href="{{ route('laporan_transaksi') }}"><i class="fa fa-file-text-o"></i> <span>Transaksi</span></a></li>
</ul>
<!-- /.sidebar-menu -->