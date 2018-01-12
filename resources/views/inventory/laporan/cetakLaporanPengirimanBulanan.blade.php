<style>
table, td, th {
    border: 1px solid #ddd;
    text-align: left;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    padding: 15px;
}

</style>
<div class="row">
  <div class="col-md-8">
    <div class="table table-responsive">
      <table class="table table-bordered table-hover">
        <center>
          <h3>Pengiriman <span id="bulan">{{$bulan}}</span></h3>
        </center>
        <tr>
          <th>Total Barang Terkirim</th>
          <th style="text-align:right">{{ $totalPengiriman}}</th>
        </tr>

      </table>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-10">
    <div class="table table-responsive">
      <table>
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
