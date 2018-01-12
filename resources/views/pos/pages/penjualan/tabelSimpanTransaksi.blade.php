<div class="panel panel-primary">
  <div class="panel-heading">
    Transaksi Yang Tersimpan
  </div>

    <table class="table table-hover">
      <thead>
        <tr>
          <th>No Penjualan</th>
          <th>Barcode</th>
          <th>Nama Barang</th>
          <th>Nilai Diskon</th>
          <th>Jumlah Item</th>
          <th>Harga</th>
          <th>Pilihan</th>
        </tr>
      </thead>
      <tbody>
        {{-- <tr>
          <td>1</td>
          <td>2</td>
          <td>3</td>
          <td>4</td>
          <td>5</td>
          <td>6</td>
          <td rowspan="2">7</td>
        </tr>
        <tr>
          <td>1</td>
          <td>2</td>
          <td>3</td>
          <td>4</td>
          <td>5</td>
          <td>6</td>
        </tr> --}}
        @foreach ($transaksiSimpan as $key => $simpan)
          <tr>
            <td>{{ $simpan->no_penjualan }}</td>
            <td>{{ $simpan->barcode }}</td>
            <td>{{ $simpan->nama_barang }}</td>
            <td>{{ $simpan->nilai_diskon }}</td>
            <td>{{ $simpan->qty }}</td>
            <td>{{ $simpan->harga_jual }}</td>
            <td>
              <button type="button"
                      class="btn btn-xs btn-success"
                      onclick="prosesTransaksi({{$simpan->no_penjualan}})">
                 Proses
              </button>
            </td>

          </tr>
        @endforeach
      </tbody>
    </table>


</div>
<script type="text/javascript">
  function prosesTransaksi(noPenjualan){
    // console.log(noTransaksi);
    $.ajax({
      url : "/pos/penjualan/prosesTransaksiSimpan",
      method : "get",
      data   : {'noPenjualan' : noPenjualan},
      success : function(response){
        console.log(response);
        $('#tabelTransaksi').load('/pos/penjualan/tabelSimpanTransaksi');
      }
    })
  }
</script>
