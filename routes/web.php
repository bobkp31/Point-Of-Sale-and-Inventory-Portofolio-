<?php

/*
* Login
*/
Route::get('/','Login\LoginController@index');
Route::post('/cekLogin','Login\LoginController@cekLogin');
Route::get('/berhasilLogin','Login\LoginController@berhasilLogin');
Route::get('/logout','Login\LoginController@logout');



Route::group(['middleware' => ['login']],function() {

  /*
  * Dashboard
  */
  Route::get('/dashboard','Dashboard\dashboardController@index');


  /*
  * Routing Persedian
  */
  Route::group(['prefix' => 'pos/persedian'],function() {
      /*
      * menu tambah Produk
      */
      // Route::get('tambahProduk','POS\Persedian\TambahProdukController@index')->middleware('login');
      // Route::get('daftarProduk','POS\Persedian\TambahProdukController@daftarProduk');
      // Route::get('dataTablesProduk','POS\Persedian\TambahProdukController@dataTablesProduk');
      // Route::get('getBarcode','POS\Persedian\TambahProdukController@getBarcode');
      // Route::get('editProduk','POS\Persedian\TambahProdukController@editProduk');
      // Route::get('hapusProduk','POS\Persedian\TambahProdukController@hapusProduk');

      //routing untuk menambah produk
      // Route::get('menambahkanProduk','POS\Persedian\TambahProdukController@tambahProduk');

      /*
      * Menu Tambah Stok
      */
      Route::get('tambahStok','POS\Persedian\TambahStokController@index');
      Route::get('daftarStok','POS\Persedian\TambahStokController@daftarStok');
      Route::get('dataTablesStok','POS\Persedian\TambahStokController@dataTablesStok');
      Route::get('tambahkanStok','POS\Persedian\TambahStokController@tambah');

      /*
      * Menu Tambah Pemasok
      */
      // Route::get('tambahPemasok','POS\Persedian\TambahPemasokController@index');
      // Route::get('daftarPemasok','POS\Persedian\TambahPemasokController@daftarPemasok');
      // Route::get('dataTablesPemasok','POS\Persedian\TambahPemasokController@dataTablesPemasok');

  });

  /*
  * End of route persedian
  */

  //--------------------------------------------------------------------------------------

  /*
  * Routing of Diskon
  */
  Route::group(['prefix' => 'pos/diskon'],function() {

      Route::get('tampilTambahDiskon','POS\Diskon\TambahDiskonController@index');
      // cari barang
      Route::get('cariBarcode','POS\Diskon\TambahDiskonController@cariBarcode');
      /*
      * Menu Diskon Pert item
      */
      Route::get('formDiskonPenjualan','POS\Diskon\TambahDiskonController@formDiskonPenjualan');
      Route::get('formDiskonItem','POS\Diskon\TambahDiskonController@formDiskonItem');
      Route::get('formDiskonAB','POS\Diskon\TambahDiskonController@formDiskonAB');
      Route::get('tabelDiskonItem','POS\Diskon\DiskonItemController@tabelDiskonItem');
      Route::get('dataTablesDiskonItem','POS\Diskon\DiskonItemController@dataTablesDiskonItem');
      Route::get('tambahDiskonItem','POS\Diskon\DiskonItemController@tambahDiskonItem');
      Route::get('getDiskonItem','POS\Diskon\DiskonItemController@getDiskonItem');
      Route::get('editDiskonItem','POS\Diskon\DiskonItemController@editDiskonItem');

      /*
      * Menu Diskon Pert Penjualan
      */
      Route::get('tabelDiskonPenjualan','POS\Diskon\DiskonPenjualanController@tabelDiskonPenjualan');

      Route::get('tambahDiskonPenjualan','POS\Diskon\DiskonPenjualanController@tambahDiskonPenjualan');
      Route::get('getIdDiskonPenjualan','POS\Diskon\DiskonPenjualanController@getIdDiskonPenjualan');
      Route::get('editDiskonPenjualan','POS\Diskon\DiskonPenjualanController@editDiskonPenjualan');

      /*
      * Diskon AB
      */
      Route::get('tabelDiskonAB','POS\Diskon\DiskonABcontroller@tabelDiskonAB');
      Route::get('tambahDiskonAB','POS\Diskon\DiskonABcontroller@tambahDiskonAB');
      Route::get('dataTablesDiskonAB','POS\Diskon\DiskonABcontroller@dataTablesDiskonAB');
      Route::get('getIdDiskonAB','POS\Diskon\DiskonABcontroller@getIdDiskonAB');
      Route::get('editDiskonAB','POS\Diskon\DiskonABcontroller@editDiskonAB');

      /*
      * Diskon Minimal N
      */
      Route::get('formDiskonJumlahMinimalN','POS\Diskon\TambahDiskonController@formDiskonJumlahMinimalN');
      Route::get('tabelJumlahMinimalN','POS\Diskon\DiskonJumlahMinimalNController@tabelJumlahMinimalN');
      Route::get('tambahDiskonMinimalN','POS\Diskon\DiskonJumlahMinimalNController@tambahDiskonMinimalN');
      Route::get('dataTablesDiskonMinimalN','POS\Diskon\DiskonJumlahMinimalNController@dataTablesDiskonMinimalN');
      Route::get('getIdDiskonMinimumN','POS\Diskon\DiskonJumlahMinimalNController@getIdDiskonMinimumN');
      Route::get('editDiskonMinimumN','POS\Diskon\DiskonJumlahMinimalNController@editDiskonMinimumN');

  });
  /*
  * End of route persedian
  */

  //----------------------------------------------------------------------------
  /*
  * Routing for penjualan
  */
  Route::group(['prefix' => 'pos/penjualan'],function(){
      Route::get('inputSaldoAwal','POS\Penjualan\PenjualanController@inputSaldoAwal');
      Route::get('inputSaldoAwalDatabase','POS\Penjualan\PenjualanController@inputSaldoAwalDatabase');
      Route::get('index','POS\Penjualan\PenjualanController@index');
      Route::get('tabelTransaksi','POS\Penjualan\PenjualanController@tabelTransaksi');
      Route::get('tabelSimpanTransaksi','POS\Penjualan\PenjualanController@tabelSimpanTransaksi');
      Route::get('cariBarang','POS\Penjualan\PenjualanController@cariBarang');

      Route::get('kotakDetailTransaksi','POS\Penjualan\DetailPenjualanController@kotakDetailTransaksi');
      Route::get('kotakPemberitahuanDiskon','POS\Penjualan\DetailPenjualanController@kotakPemberitahuanDiskon');
      Route::get('bayarTransaksi','POS\Penjualan\DetailPenjualanController@bayarTransaksi');
      Route::get('getTransaksiDiProses','POS\Penjualan\DetailPenjualanController@getTransaksiDiProses');
      Route::get('hapusTransaksi','POS\Penjualan\DetailPenjualanController@hapusTransaksi');
      Route::get('ubahTransaksi','POS\Penjualan\DetailPenjualanController@ubahTransaksi');


      Route::get('cobaDiskonPenjualan','POS\Penjualan\DetailPenjualanController@cobaDiskonPenjualan');
      Route::get('coba','POS\Penjualan\PenjualanController@coba');

      Route::get('printBill/{id}','POS\Penjualan\DetailPenjualanController@printBill');
      Route::get('rekapKas','POS\Penjualan\DetailPenjualanController@rekapKas');

      Route::get('simpanTransaksi','POS\Penjualan\PenjualanController@simpanTransaksi');
      Route::get('prosesTransaksiSimpan','POS\Penjualan\DetailPenjualanController@prosesTransaksiSimpan');
  });



  //----------------------------------------------------------------------------
  /*
  * Routing for Kepegawaian
  */
  Route::group(['prefix' => 'kepegawaian/'],function() {
      Route::get('daftarPegawai','Kepegawaian\KepegawaianController@tampilDaftarPegawai');
      Route::get('tabelPegawai','Kepegawaian\DaftarPegawaiController@tabelPegawai');
      Route::get('dataTablesPegawai','Kepegawaian\DaftarPegawaiController@dataTablesPegawai');
      Route::get('tambahPegawai','Kepegawaian\DaftarPegawaiController@tambahPegawai');
      Route::get('getIdPegawai','Kepegawaian\DaftarPegawaiController@getIdPegawai');
      Route::get('editPegawai','Kepegawaian\DaftarPegawaiController@editPegawai');
      Route::get('hapusPegawai','Kepegawaian\DaftarPegawaiController@hapusPegawai');

      #daftar akun
      Route::get('daftarAkun','Kepegawaian\KepegawaianController@tampilDaftarAkun');
      Route::get('tabelAkun','Kepegawaian\AkunController@tabelAkun');
      Route::get('dataTablesAkun','Kepegawaian\AkunController@dataTablesAkun');
      Route::get('tambahAkun','Kepegawaian\AkunController@tambahAkun');
      Route::get('getIdAkun','Kepegawaian\AkunController@getIdAkun');
      Route::get('editAkun','Kepegawaian\AkunController@editAkun');
      Route::get('hapusAkun','Kepegawaian\AkunController@hapusAkun');

  });


  //----------------------------------------------------------------------------
  /*
  * Routing for Inventory
  */
  Route::group(['prefix' => 'inventory/'],function() {
      #Routing untuk Faktur
      Route::get('faktur/index','Inventory\InventoryController@showIndexFaktur');
      Route::get('faktur/formTambahFaktur','Inventory\InventoryFakturController@formTambahFaktur');
      Route::get('faktur/daftarTambahFaktur','Inventory\InventoryFakturController@daftarTambahFaktur');
      #Tambah Faktur dan update setelah semua detail faktur masuk
      Route::get('faktur/tambahFaktur','Inventory\InventoryFakturController@tambahFaktur');
      Route::get('faktur/updateFaktur','Inventory\InventoryFakturController@updateFaktur');
      #Cari Barcode di form tambah faktur
      Route::get('faktur/cariBarcodeFaktur','Inventory\InventoryFakturController@cariBarcodeFaktur');
      #Tambah Detail Faktur
      Route::get('faktur/tambahDetailFaktur','Inventory\InventoryFakturController@tambahDetailFaktur');
      #Cetak Faktur
      Route::get('faktur/cetakFaktur/{nofaktur}/{pemasok}','Inventory\InventoryFakturController@cetakFaktur');


      #Routing untuk Barang
      Route::get('barang/index','Inventory\InventoryController@showIndexBarang');
      Route::get('barang/kotakDetailBarang','Inventory\InventoryBarangController@kotakDetailBarang');
      Route::get('barang/tambahKategori','Inventory\InventoryBarangController@tambahKategori');
      Route::get('barang/optionKategori','Inventory\InventoryBarangController@optionKategori');
      Route::get('barang/tabelKategori','Inventory\InventoryBarangController@tabelKategori');
      Route::get('barang/formEditKategori','Inventory\InventoryBarangController@formEditKategori');
      Route::get('barang/editKategori','Inventory\InventoryBarangController@editKategori');
      Route::get('barang/tambahBarang','Inventory\InventoryBarangController@tambahBarang');
      Route::get('barang/dataTablesBarang','Inventory\InventoryBarangController@dataTablesBarang');
      Route::get('barang/getBarang','Inventory\InventoryBarangController@getBarang');
      Route::get('barang/editBarang','Inventory\InventoryBarangController@editBarang');
      Route::get('barang/cetakSemuaBarang','Inventory\InventoryBarangController@cetakSemua');

      #Routing untuk Kirim
      Route::get('kirim/index','Inventory\InventoryController@showIndexKirim');
      Route::get('kirim/formKirim','Inventory\InventoryKirimController@formKirim');
      Route::get('kirim/cariBarang','Inventory\InventoryKirimController@cariBarang');
      Route::get('kirim/tambahBarangKirim','Inventory\InventoryKirimController@tambahBarangKirim');
      Route::get('kirim/getBarcode','Inventory\InventoryKirimController@getBarcode');
      Route::get('kirim/editDetailPegiriman','Inventory\InventoryKirimController@editDetailPegiriman');
      Route::get('kirim/kartuStok','Inventory\InventoryKirimController@kartuStok');
      Route::get('kirim/kirimBarang','Inventory\InventoryKirimController@kirimBarang');
      Route::get('kirim/cetakKartuPengiriman/{noPengiriman}','Inventory\InventoryKirimController@cetakKartuPengiriman');

      #Routing untuk Harga Jual
      Route::get('hargaJual/index/','Inventory\InventoryHargaJualController@index');
      Route::get('hargaJual/cariBarang/','Inventory\InventoryHargaJualController@cariBarang');
      Route::get('hargaJual/ubahHargaJual/','Inventory\InventoryHargaJualController@ubahHargaJual');

      #Routing untuk Arsip
      Route::get('arsip/index/','Inventory\InventoryArsipController@arsipIndex');
      Route::get('arsip/tabelDaftarFaktur/','Inventory\InventoryArsipController@tampilTabelDaftarFaktur');
      Route::get('arsip/dataTablesArsip/{hari}','Inventory\InventoryArsipController@dataTabelsArsip');
      Route::get('arsip/tabelDaftarFakturBulanan/','Inventory\InventoryArsipController@tampilTabelDaftarFakturBulanan');
      Route::get('arsip/dataTablesArsipBulanan/{bulan}','Inventory\InventoryArsipController@dataTabelsArsipBulanan');
      Route::get('arsip/lihatDetailFaktur','Inventory\InventoryArsipController@lihatDetailFaktur');

      #Routing untuk Laporan Arsip
      Route::get('laporan/index/','Inventory\InventoryLaporanController@indexLaporan');
      Route::get('laporan/laporanPengiriman/','Inventory\InventoryLaporanPengirimanController@laporanPengiriman');
      Route::get('laporan/laporanPengirimanHarian/','Inventory\InventoryLaporanPengirimanController@detailLaporanPengirimanHarian');
      Route::get('laporan/cetakLaporanPengirimanHarian/{hari}','Inventory\InventoryLaporanPengirimanController@cetakLaporanPengirimanHarian');
      Route::get('laporan/laporanPengirimanBulanan/','Inventory\InventoryLaporanPengirimanController@detailLaporanPengirimanBulanan');
      Route::get('laporan/cetakLaporanPengirimanBulanan/{bulan}','Inventory\InventoryLaporanPengirimanController@cetakLaporanPengirimanBulanan');


  });


  //----------------------------------------------------------------------------
  /*
  * Routing for Pemasok
  */
  Route::group(['prefix' => 'pemasok/'],function() {
      Route::get('tambahPemasok/index','Pemasok\PemasokController@showIndexTambahPemasok');
      Route::get('tambahPemasok/daftarPemasok','Pemasok\TambahPemasokController@daftarPemasok');
      Route::get('tambahPemasok/tambah','Pemasok\TambahPemasokController@tambahPemasok');
      Route::get('tambahPemasok/dataTablesPemasok','Pemasok\TambahPemasokController@dataTablesPemasok');
      Route::get('tambahPemasok/get_id','Pemasok\TambahPemasokController@get_id');
      Route::get('tambahPemasok/editPemasok','Pemasok\TambahPemasokController@editPemasok');
  });
  //----------------------------------------------------------------------------
  /*
  * Routing for Laporan
  */
  Route::group(['prefix' => 'laporan/'],function() {
      Route::get('index','Laporan\LaporanController@index');
      Route::get('laporanPenjualan','Laporan\LaporanPenjualanController@laporanPenjualan');

      Route::get('formHarian','Laporan\LaporanController@formHarian');
      Route::get('formBulanan','Laporan\LaporanController@formBulanan');

      Route::get('tampilLaporanPenjualanHarian','Laporan\LaporanPenjualanController@tampilLaporanPenjualanHarian');
      Route::get('tampilLaporanPenjualanBulanan','Laporan\LaporanPenjualanController@tampilLaporanPenjualanBulanan');

      #CETAK LAPORAN
      Route::get('cetakLaporanPenjualanHarian/{hari}','Laporan\LaporanPenjualanController@cetakLaporanPenjualanHarian');
      Route::get('cetakLaporanPenjualanBulanan/{bulan}','Laporan\LaporanPenjualanController@cetakLaporanPenjualanBulanan');

  });




});
/*
* End of Group routing middleware Login
*/






/*
* routing nevada
* i use this routing for testing
*/
Route::group(['prefix' => 'nevada'],function(){
    Route::get('index','nevadaController@index');
    Route::get('setSession','nevadaController@setSession');
    Route::get('viewSession','nevadaController@viewSession');
    Route::get('delSession','nevadaController@delSession');
    // Route::get('printBill/{id?}','nevadaController@printBill');

     Route::get('routing/{id}/{id2}','nevadaController@routing2parameter');

});
