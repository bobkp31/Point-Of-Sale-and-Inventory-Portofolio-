<div class="row">
  <div class="col-md-8">
    <div class="table table-responsive">
      <table class="table table-bordered table-hover">
        <h3>Penjualan <span id="bulan">{{ $bulan }}</span></h3>
        <tr>
          <th>Total Quantity</th>
          <th style="text-align:right">{{ $totalQty }}</th>
        </tr>

        <tr>
          <th>Potongan Item</th>
          <th style="text-align:right">
            Rp. {{ number_format($totalDiskonItem,'0', '.', '.') }}
          </th>
        </tr>

        <tr>
          <th>Potongan Penjualan</th>
          <th style="text-align:right">
            Rp. {{ number_format($totalDiskonPenjualan,'0', '.', '.') }}
          </th>
        </tr>

        <tr>
          <th>Total Tunai</th>
          <th style="text-align:right">
            Rp. {{ number_format($totalTunai,'0', '.', '.') }}
          </th>
        </tr>

        <tr>
          <th>Total Debit</th>
          <th style="text-align:right">
            Rp. {{ number_format($totalDebit,'0', '.', '.') }}
          </th>
        </tr>

        <tr>
          <th>Total Penjualan Tunai & Debit</th>
          <th style="text-align:right">
            Rp. {{ number_format($totalTunaiDebit,'0', '.', '.') }}
          </th>
        </tr>

        <tr>
          <th>Total HPP</th>
          <th style="text-align:right">
            Rp. {{ number_format($totalHpp,'0', '.', '.') }}
          </th>
        </tr>

        <tr>
          <th>Margin Penjualan</th>
          <th style="text-align:right">
            Rp. {{ number_format($margin,'0', '.', '.') }}
          </th>
        </tr>
      </table>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-md-10">
    <div class="table table-responsive">
      <table class="table table-bordered table-hover">
        <h3>Detail Penjualan</h3>
        <tr>
          <th style="text-align:center">Nama Barang</th>
          <th style="text-align:center">Quantity</th>
          <th style="text-align:center">Total</th>
        </tr>
        @foreach ($detailProduk as $detail)
          <tr>
            <td>{{ $detail->nama_barang }}</td>
            <td style="text-align:center">{{ $detail->totalQty }}</td>
            <td style="text-align:right">Rp. {{ number_format($detail->total,'0', '.', '.') }}</td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
</div>

<button class="btn btn-denger"
        id="btn-cetakLaporanPenjualanBulanan">
  Cetak
</button>

<script type="text/javascript">
  var bulan =  $('#bulan').val();
  $('#btn-cetakLaporanPenjualanBulanan').click(function(){
    var page = window.open('/laporan/cetakLaporanPenjualanBulanan/'+ bulan+ '','popupwindow','scrollbars=yes, width=750,height=600');
    page.print();
    // console.log(bulan);
  })
</script>
