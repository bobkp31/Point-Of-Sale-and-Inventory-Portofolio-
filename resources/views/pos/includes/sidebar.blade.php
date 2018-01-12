<div class="col-md-2">
  		  	<div class="sidebar content-box" style="display: block;">
                  <ul class="nav">
                      <!-- Main menu -->
                      <li class="current">
                        <a href="/dashboard">
                          <i class="glyphicon glyphicon-home">
                        </i> Dashboard</a>
                      </li>

                  @if (session('hak_akses') == 'Owner' || session('hak_akses') == 'Manager' )
                    <!--Menu Pegawai -->
                    <li class="submenu">
                      <a href="#">
                        <i class="glyphicon glyphicon-list"></i> Pegawai
                        <span class="caret pull-right"></span>
                      </a>
                      <!-- Sub menu -->
                      <ul>
                        <li><a href="/kepegawaian/daftarPegawai">Daftar Pegawai</a></li>
                        <li><a href="/kepegawaian/daftarAkun">Akun</a></li>
                      </ul>
                    </li>

                    <!--Menu Diskon -->
                    <li class="submenu">
                      <a href="#">
                        <i class="glyphicon glyphicon-list"></i> Diskon
                        <span class="caret pull-right"></span>
                      </a>
                      <!-- Sub menu -->
                      <ul>
                        <li><a href="/pos/diskon/tampilTambahDiskon">Tambah Diskon</a></li>
                        {{-- <li><a href="#">History Diskon</a></li> --}}
                      </ul>
                    </li>

                    <!--Menu Inventory -->
                    <li class="submenu">
                      <a href="#">
                        <i class="fa fa-university" aria-hidden="true"></i> Inventory
                        <span class="caret pull-right"></span>
                      </a>
                      <!-- Sub menu -->
                      <ul>
                        <li>
                          <a href="/inventory/barang/index">
                            Kartu Stok
                          </a>
                        </li>
                        <li>
                          <a href="/inventory/faktur/index">
                            Input Faktur
                          </a>
                        </li>
                        <li>
                          <a href="/inventory/arsip/index">
                            Arsip Faktur
                          </a>
                        </li>
                        <li>
                          <a href="/inventory/kirim/index">
                            Kirim
                          </a>
                        </li>
                        <li>
                          <a href="/inventory/hargaJual/index">
                            Harga Jual
                          </a>
                        </li>
                        <li>
                          <a href="/inventory/laporan/index">
                            Laporan
                          </a>
                        </li>
                        {{-- <li><a href="#">History Diskon</a></li> --}}
                      </ul>
                    </li>


                    <!--Menu Pemasok -->
                    <li class="submenu">
                      <a href="#">
                        <i class="fa fa-user-circle" aria-hidden="true"></i> Pemasok
                        <span class="caret pull-right"></span>
                      </a>
                      <!-- Sub menu -->
                      <ul>
                        <li>
                          <a href="/pemasok/tambahPemasok/index">
                            Tambah Pemasok
                          </a>
                        </li>
                        {{-- <li><a href="#">History Diskon</a></li> --}}
                      </ul>
                    </li>
                  @endif

                      <!-- Menu Persedian -->
                      <li class="submenu">
                        <a href="#">
                          <i class="glyphicon glyphicon-list"></i> Stok Toko
                          <span class="caret pull-right"></span>
                        </a>
                        <!-- Sub menu -->
                        <ul>
                          <li><a href="/pos/persedian/tambahStok">Lihat Stok</a></li>
                          {{-- <li><a href="/pos/persedian/tambahProduk">Tambah Produk</a></li> --}}
                          {{-- <li><a href="/pos/persedian/tambahPemasok">Tambah Pemasok</a></li> --}}
                        </ul>
                      </li>

                      <!-- Menu Laporan -->
                      <li>
                        <a href="/laporan/index">
                          <i class="glyphicon glyphicon-list-alt"></i> Laporan
                        </a
                      </li>

                      <li><a href="/logout"><i class="glyphicon glyphicon-log-out"></i>Keluar</a></li>
                  </ul>
            </div>
  	</div>
