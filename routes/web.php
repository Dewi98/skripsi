<?php

use Illuminate\Http\Request;

/** halaman pengguna */
/** halaman beranda Utama */
Route::get('/', 'Pengguna\BerandaController@index')->name('beranda');
Route::get('get_kategori', function() {

    $kategori = [];

    foreach(DB::table('tbl_kategori')->select('nama_kategori')->get() as $key => $value) {
        $kategori[] = $value->nama_kategori;
    }

    return response()->json($kategori);

})->name('get_kategori');
Route::get('get_data_counter', function() {

    $pembayaran = DB::table('tbl_pembayaran')->where([
        ['id_pengguna', session('id_pengguna')],
    ]);

    $list = [
        'keranjang' => DB::table('tbl_keranjang')->where('id_pengguna', session('id_pengguna'))->count(),
        'pesanan'   => DB::table('tbl_pesanan')->where([['id_pengguna', '=', session('id_pengguna')], ['status_pesanan', '<=', 4]])->count(),
        'pembayaran'=> !empty($pembayaran->first()->foto_bukti) && $pembayaran->first()->selesai != 1  ? $pembayaran->count() : '0',
    ];

    return response()->json($list);

})->name('data_counter');
Route::post('hubungi', 'Pengguna\EmailController@kontak')->name('hubungi_kami');

/** Halaman Autentikasi Pengguna */
Route::get('masuk', 'Pengguna\Autentikasi\LoginController@index')->name('login');
Route::get('daftar', 'Pengguna\Autentikasi\RegisterController@index')->name('register');
Route::get('keluar', 'Pengguna\Autentikasi\LoginController@logout')->name('logout');
Route::post('masuk', 'Pengguna\Autentikasi\LoginController@login')->name('proses_login');
Route::post('daftar', 'Pengguna\Autentikasi\RegisterController@register')->name('proses_regis');

/** Halaman Lupa Password Pengguna */
Route::get('lupa-password', 'Pengguna\Autentikasi\ResetPasswordController@index')->name('lupa_password');
Route::get('lupa-password/reset', 'Pengguna\Autentikasi\ResetPasswordController@reset_page')->name('reset_page');
Route::post('lupa-password/send', 'Pengguna\Autentikasi\ResetPasswordController@send_token')->name('send_token');
Route::put('lupa-password/proses', 'Pengguna\Autentikasi\ResetPasswordController@reset_password')->name('proses_password');

/** Halaman Akun Pengguna */
Route::get('info_akun', 'Pengguna\Akun\AkunController@index')->name('info_akun');
Route::get('info_akun/edit', 'Pengguna\Akun\InformasiAkunController@index')->name('edit_info_akun');
Route::get('info_akun/ganti_password', 'Pengguna\Akun\GantiPasswordController@index')->name('ganti_password');
Route::put('info_akun/edit', 'Pengguna\Akun\InformasiAkunController@simpan_informasi')->name('simpan_info_akun');
Route::put('info_akun/ganti_password', 'Pengguna\Akun\GantiPasswordController@simpan_password')->name('simpan_password');

/** Halaman Produk*/
Route::get('produk', 'Pengguna\Produk\ProdukController@index')->name('produk');
Route::get('produk/detail/{id_barang}', 'Pengguna\Produk\DetailProdukController@index')->name('detail_produk');
Route::post('produk/tambah-keranjang/{id_barang}', 'Pengguna\Produk\DetailProdukController@masukan_keranjang')->name('tambah_keranjang');

/** Halaman Keranjang */
Route::get('keranjang', 'Pengguna\Keranjang\KeranjangController@index')->name('keranjang');
Route::put('keranjang/update/{id_barang}', 'Pengguna\Keranjang\KeranjangController@update')->name('update_keranjang');
Route::delete('keranjang/delete/{id_barang}', 'Pengguna\Keranjang\KeranjangController@delete')->name('delete_keranjang');
Route::post('keranjang/method', 'Pengguna\Keranjang\KeranjangController@method')->name('checkout_method');

/** Halaman Checkout */
Route::get('checkout/{method}', 'Pengguna\Keranjang\CheckoutController@index')->name('checkout_keranjang');
Route::get('selesai', function(){
    return view('pengguna.keranjang.terimakasih');
});
Route::get('get_provinsi', function() {
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "UTF-8",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "key: 1a84ef0ff7cac9bb764f1087e64da8d3"
        ],
    ]);

    $result = curl_exec($curl);

    return response()->json($result);
});
Route::get('get_kota', function(Request $request) {
    $curl = curl_init();

    $id = $request->input('provinsi');

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "UTF-8",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "key: 1a84ef0ff7cac9bb764f1087e64da8d3"
        ],
    ]);

    $result = curl_exec($curl);

    return response()->json($result);
});
Route::post('get_cost', function(Request $request) {
    $curl = curl_init();

    $id_city     = $request->input('kota');
    $berat       = $request->input('berat');

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin=115&destination=".$id_city."&weight=".$berat."&courier=jne",
        CURLOPT_HTTPHEADER => [
            'content-type: application/x-www-form-urlencoded',
            "key: 1a84ef0ff7cac9bb764f1087e64da8d3"
        ],
    ]);

    $result = curl_exec($curl);

    return response()->json($result);
});
Route::post('checkout', 'Pengguna\Keranjang\CheckoutController@save_checkout')->name('save_checkout');

/** Halaman Pesanan*/
Route::get('pesanan', 'Pengguna\Pesanan\PesananController@index')->name('pesanan');
Route::get('pesanan/detail_pesanan/{id_pesanan}', 'Pengguna\Pesanan\PesananController@detail_pesanan')->name('detail_pesanan');
Route::get('pesanan/riwayat', 'Pengguna\Pesanan\PesananController@riwayat_pesanan')->name('riwayat_pesanan');
Route::put('pesanan/dibatalkan/{id_pesanan}', 'Pengguna\Pesanan\PesananController@dibatalkan')->name('pesanan_dibatalkan');
Route::put('pesanan/konfirmasi/{id_pesanan}', 'Pengguna\Pesanan\PesananController@konfirmasi_pesanan')->name('konfirmasi_pesanan');

/** Halaman Pembayaran*/
Route::get('pembayaran', 'Pengguna\Pesanan\PembayaranController@index')->name('pembayaran');
Route::get('pembayaran/upload-bukti/{id_pesanan}', 'Pengguna\Pesanan\PembayaranController@upload_bukti')->name('upload_bukti');
Route::put('pembayaran/upload-bukti/{id_pesanan}/save', 'Pengguna\Pesanan\PembayaranController@save_bukti')->name('save_bukti');

/** Halaman Invoice*/
Route::get('invoice/{id_invoice}', 'Pengguna\Pesanan\PesananController@invoice')->name('invoice');

/** halaman admin */
Route::group(['prefix' => 'admin'], function(){
    
/** Halaman Beranda Utama */
Route::get('/beranda-admin', 'Admin\BerandaController@index')->name('beranda_admin');
Route::get('sidebar_counter', function() {
    $table = ['barang', 'kategori', 'merk', 'pengguna', 'admin', 'pesanan', 'pembayaran', 'pengiriman'];
    $data = [];
    
    foreach($table as $key) {
        if($key == 'pengiriman') {
            
            $data[] = DB::table('tbl_pesanan')->select('id_pesanan')
                ->where('status_pesanan', 3)->count();
            
            } else if ($key == 'pesanan') {

            $data[] = DB::table('tbl_pesanan')->select('id_pesanan')
                ->whereBetween('status_pesanan', [1, 2])->count();

            } else if($key == 'pembayaran') {

            $data[] = DB::table('tbl_pembayaran')->select('id_pesanan')
                    ->where('selesai', 0)->count();

            } else {

            $data[] = DB::table('tbl_'.$key)->count();
        }
    }
    
    return response()->json($data);
}); // AJAX

/** Halaman Beranda Utama */
Route::get('profile/{id_admin}', 'Admin\ProfileController@index')->name('profile_admin');
Route::put('profile/ganti_password/{id_admin}', 'Admin\ProfileController@ganti_password')->name('ganti_password_admin');

/** Halaman Autentikasi */
Route::get('login', 'Admin\Autentikasi\LoginController@index')->name('login_admin');
Route::get('logout', 'Admin\Autentikasi\LoginController@logout')->name('logout_admin');
Route::post('login', 'Admin\Autentikasi\LoginController@login')->name('proses_login_admin');

/** Halaman Produk */
Route::get('produk', 'Admin\Produk\ProdukController@index')->name('list_produk');
Route::get('get_produk/{id_barang}', function($id_barang) {
    $data = DB::table('tbl_barang')->where('id_barang', $id_barang)->first();
    
    return response()->json($data);
}); // AJAX

Route::post('produk', 'Admin\Produk\ProdukController@tambah_produk')->name('tambah_produk');
Route::put('edit_produk/{id_barang}', 'Admin\Produk\ProdukController@edit_produk');
Route::delete('hapus_produk/{id_barang}', 'Admin\Produk\ProdukController@hapus_produk');
/** Halaman Kategori */
Route::get('kategori', 'Admin\Produk\KategoriController@index')->name('kategori_produk');
Route::get('check_kategori/{nama_kategori}', function($nama_kategori){
    
    $nama_kategori = str_replace('%20', ' ', $nama_kategori);

    $data = DB::table('tbl_kategori')->where('nama_kategori', $nama_kategori)->exists();
    
    return response()->json($data);
}); // AJAX

Route::post('kategori', 'Admin\Produk\KategoriController@tambah_kategori')->name('tambah_kategori');
Route::put('edit_kategori/{id_kategori}', 'Admin\Produk\KategoriController@edit_kategori');
Route::delete('hapus_kategori/{id_kategori}', 'Admin\Produk\KategoriController@hapus_kategori');

/** Halaman Merk */
Route::get('merk', 'Admin\Produk\MerkController@index')->name('merk_produk');
Route::get('check_merk', 'Admin\Produk\MerkController@check_merk'); // AJAX
Route::post('tambah_merk', 'Admin\Produk\MerkController@tambah_merk')->name('tambah_merk');
Route::put('edit_merk/{id_merk}', 'Admin\Produk\MerkController@edit_merk');
Route::delete('hapus_merk/{id_merk}', 'Admin\Produk\MerkController@hapus_merk');

/** Halaman Superadmin : Admin */
Route::get('superadmin/admin', 'Admin\Superadmin\AdminController@index')->name('superadmin_admin');
Route::get('superadmin/blokir_admin/{id_admin}', 'Admin\Superadmin\AdminController@blokir_admin')->name('blokir');
Route::get('superadmin/get_admin/{id_admin}', 'Admin\Superadmin\AdminController@get_admin'); // AJAX
Route::post('superadmin/tambah_admin', 'Admin\Superadmin\AdminController@tambah_admin')->name('tambah_admin');
Route::put('superadmin/edit_admin/}id_admin}', 'Admin\Superadmin\AdminController@edit_admin');
Route::put('superadmin/ubah_status_admin/{id_admin}', 'Admin\Superadmin\AdminController@ubah_status_admin');
Route::delete('superadmin/hapus_admin/{id_admin}', 'Admin\Superadmin\AdminController@hapus_admin');
/** Halaman Superadmin : Pengguna */
Route::get('superadmin/pengguna', 'Admin\Superadmin\PenggunaController@index')->name('superadmin_pengguna');
Route::get('superadmin/get_pengguna/{id_pengguna}', 'Admin\Superadmin\PenggunaController@get_pengguna'); // AJAX
Route::delete('superadmin/hapus_pengguna/{id_pengguna}', 'Admin\Superadmin\PenggunaController@hapus_pengguna');

/** Halaman Transaksi : Pembayaran */
Route::get('transaksi/pembayaran', 'Admin\Transaksi\PembayaranController@index')->name('pembayaran_admin');
Route::get('transaksi/get_pembayaran/{id_pesanan}', 'Admin\Transaksi\PembayaranController@get_pembayaran'); // AJAX
Route::put('transaksi/pembayaran/status/{id_pesanan}', 'Admin\Transaksi\PembayaranController@rubah_status')->name('rubah_status_pembayaran');

/** Halaman Transaksi : Pesanan */
Route::get('transaksi/pesanan', 'Admin\Transaksi\PesananController@index')->name('pesanan_admin');
Route::get('transaksi/pesanan/detail/{id_pesanan}', 'Admin\Transaksi\PesananController@detail_pesanan')->name('detail_pesanan_admin');
Route::get('transaksi/get_penerima/{id_pesanan}', 'Admin\Transaksi\PesananController@get_info_penerima'); // AJAX
Route::put('transaksi/proses_pesanan/{id_pesanan}', 'Admin\Transaksi\PesananController@proses_pesanan');
Route::put('transaksi/kirim_pesanan/{id_pesanan}', 'Admin\Transaksi\PesananController@kirim_pesanan');
Route::put('transaksi/batalkan_pesanan/{id_pesanan}', 'Admin\Transaksi\PesananController@batalkan_pesanan');
Route::put('transaksi/edit_pesanan/{id_pesanan}', 'Admin\Transaksi\PesananController@edit_pesanan');
Route::delete('transaksi/hapus_pesanan/{id_pesanan}', 'Admin\Transaksi\PesananController@hapus_pesanan');

/** Halaman Transaksi : Pengiriman */
Route::get('transaksi/pengiriman', 'Admin\Transaksi\PengirimanController@index')->name('pengiriman_admin');
Route::put('transaksi/selesai/{id_pesanan}', 'Admin\Transaksi\PengirimanController@selesai');
Route::put('transaksi/dibatalkan/{id_pesanan}', 'Admin\Transaksi\PengirimanController@batalkan_pesanan');

/** Halaman Laporan : Transaksi */
Route::get('laporan/transaksi', 'Admin\Laporan\TransaksiController@index')->name('laporan_transaksi');
Route::post('laporan/transaksi/print', 'Admin\Laporan\TransaksiController@print_transaksi')->name('print_transaksi');
Route::get('/resep', 'Admin\Resep\ResepController@index');
//Route::get('/resep/tambah', 'Admin\Resep\ResepController@tambah_resep')->name('tambah_resep_admin');
Route::post('resep', 'Admin\Resep\ResepController@tambah_resep')->name('tambah_resep');

});

/** test route */
Route::get('test', 'Test\TestingController@index')->name('test');
Route::get('page', 'Test\TestingController@page')->name('page_test');
// Route::get('test', function(Request $request) {
//     return view('test');
// });
Route::post('test', 'Test\TestingController@test')->name('test_form');
Route::get('send', 'Pengguna\EmailController@lupa_password');

/** Halaman resep*/
//Route::get('/resep', 'Resep\ResepController@resep')->name('resep');
// Route::get('/resep', 'Pengguna\Resep\ResepController@index');
//Route::get('/resep', 'Pengguna\Resep\ResepController@index')->name('resep');
Route::get('/resep', 'Pengguna\Resep\ResepController@index')->name('resep');
//Route::post('/resep/tambah', 'Pengguna\Resep\ResepController@tambah_resep')->name('tambah_resep');
Route::put('/resep/edit_resep/{id_resep}', 'Pengguna\Resep\ResepController@edit_resep');
Route::delete('/resep/hapus_resep/{id_resep}', 'Pengguna\Resep\ResepController@hapus_resep');
Route::post('/resep/save', 'Resep\ResepController@save_resep')->name('save_resep');
//Route::get('resep/{id_resep}', 'Resep\ResepController@index')->name('resep');


Route::get('checkout/proses-pesanan', 'Pengguna\Transaksi\PembayaranController@index');
Route::post('checkout/proses-pesanan', 'Admin\Transaksi\PembayaranController@prosesPesanan');

//Menu
// Route::get('/add', function () {
//     return view('add');
// Route::get('/admin', 'MenuController@show_by_admin');
// });
// Route::get('/', 'MenuController@show');
// Route::post('/add_process', 'MenuController@add_process');
// Route::get('/detail/{id}', 'MenuController@detail');
// Route::get('/add', 'MenuController@add');
// Route::get('/', 'MenuController@show');
// Route::get('/edit/{id}', 'MenuController@edit');
// Route::post('/edit_process', 'MenuController@edit_process');
// Route::get('/delete/{id}', 'MenuController@delete');