<div class="panel panel-primary">
  <div class="panel-heading">
    Pilih Transaksi Yang akan di hapus
  </div>

    <table class="table table-hover">
      <thead>
        <tr>
          <th>Barang</th>
          <th>Nama Barang</th>
          <th>Jumlah Item</th>
          <th>Harga</th>
          <th>Hapus</th>
          <th>Ubah</th>
        </tr>
      </thead>
      <tbody>
            @foreach ($transaksi as $transaksiPenjualan)
              <tr>
                <input type="hidden" name="name" value="{{ $transaksiPenjualan->id_transaksi_penjualan }}">
                {{-- <input type="hidden" id="barcode" value="{{ $transaksiPenjualan->barcode }}"> --}}
                <td>{{ $transaksiPenjualan->barcode }}</td>
                <td>{{ $transaksiPenjualan->nama_barang }}</td>
                <td>
                  <div class="row">
                    <div class="col-xs-3">
                      <input type="text"
                             id="{{$transaksiPenjualan->id_transaksi_penjualan}}"
                             class="form-control"
                             value="{{ $transaksiPenjualan->qty }}">
                    </div>
                  </div>
                </td>
                <td>{{ $transaksiPenjualan->harga_jual }}</td>
                <td>
                  <button class="btn btn-danger btn-xs"
                          onclick="hapusTransaksi({{ $transaksiPenjualan->id_transaksi_penjualan }},
                                                  {{ $transaksiPenjualan->qty }})">
                    Hapus
                  </button>
                </td>
                <td>
                  <button class="btn btn-primary btn-xs"
                          onclick="ubahTransaksi({{ $transaksiPenjualan->id_transaksi_penjualan }},
                                                  {{ $transaksiPenjualan->barcode }},
                                                  {{ $transaksiPenjualan->qty }},
                                                  {{ $transaksiPenjualan->id_stok }})">
                    Ubah
                  </button>
                </td>
              </tr>
            @endforeach
      </tbody>
    </table>
</div>

<script type="text/javascript">
  function hapusTransaksi(id,qty){
    $.ajax({
      url    : '/pos/penjualan/hapusTransaksi',
      method : 'get',
      data   : {'id' : id,
                'qty' : qty},
      success : function(response){
        console.log(response);
        $('#kotakDetailTransaksi').load('/pos/penjualan/kotakDetailTransaksi');
        $('#tabelTransaksi').load('/pos/penjualan/getTransaksiDiProses');
      }
    })
  }

  function ubahTransaksi(id,barcode,qty,idStok){
    var qtyEdit = $('#'+id).val();
    // console.log(idStok);
    $.ajax({
      url    : '/pos/penjualan/ubahTransaksi',
      method : 'get',
      data   : {'id' : id,
                'barcode' : barcode,
                'qty' : qty,
                'qtyEdit' : qtyEdit,
                'idStok' : idStok},
      success : function(response){
        console.log(response);
        $('#tabelTransaksi').load('/pos/penjualan/getTransaksiDiProses');
      }
    })
  }
</script>
