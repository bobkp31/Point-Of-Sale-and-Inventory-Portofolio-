
<div class="row">
  <div class="col-md-8">
    <div class="table table-responsive">
      <table class="table table-bordered table-hover">
        <h3>Pengiriman <span id="hari">{{$bulan}}</span></h3>
        <tr>
          <th>Total Barang Terkirim</th>
          <th style="text-align:right">{{ $totalPengiriman}}</th>
        </tr>

      </table>
    </div>
  </div>
</div>

<hr>
<div class="row">
  <div class="col-md-10">
    <div class="table table-responsive">
      <table class="table table-bordered table-hover">
        <h3>Pengiriman</h3>
        <tr>
          <th style="text-align:center">Nama Barang</th>
          <th style="text-align:center">Barcode</th>
          <th style="text-align:center">Jumlah</th>
          <th style="text-align:center">Waktu</th>
        </tr>
        @foreach ($pengirimanHarian as $detail)
          <tr>
            <td>{{ $detail->nama_barang }}</td>
            <td>{{ $detail->barcode }}</td>
            <td style="text-align:center">{{ $detail->jumlah }}</td>
            <td style="text-align:right">{{ $detail->waktu}}</td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
</div>

<button type="button" name="button" class="btn btn-default" onclick="cetak()" >cetak</button>

<script type="text/javascript">
  function cetak()
  {
    var bulan = $('#bulan').val();
    console.log(bulan);
     var page = window.open('/inventory/laporan/cetakLaporanPengirimanBulanan/'+bulan+'','popupwindow','scrollbars=yes, width=750,height=600');
     page.print();
  }

</script>
