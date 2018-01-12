<h3 style="text-align:right">Total Pembayaran</h3>
<h3>
  Rp.  <span id="totalBayar">
          {{ number_format($detailTransaksi[0]->total - $diskonTransaksi, 0, '.', '.')}}
       </span>
  {{-- Rp.  {{ number_format($detailTransaksi[0]->total - $detailTransaksi[0]->totalDiskon - $diskonTransaksi, 0, '.', '.')}} --}}
</h3>

<hr>
<h4>Total Item  {{ $detailTransaksi[0]->totalItem }} </h4>
<h4>Total Potongan Item Rp. <span id="textTotalDiskonItem">{{ number_format($detailTransaksi[0]->totalDiskon, 0, '.', '.')}}</span> </h4>
<hr>

<h4>Potongan Transaksi Rp. <span id='textDiskonTransaksi'>{{ number_format($diskonTransaksi, 0, '.', '.') }}</span></h4>
{{-- <h4>PPN (10%) Rp. <span id='ppn'> </span></h4> --}}

<hr>
<h4>
  Total Belanja Rp.
  <span id="totalTransaksi">
    {{ number_format($detailTransaksi[0]->total + $detailTransaksi[0]->totalDiskon, 0, '.', '.') }}
  </span>
</h4>
<h4>Pembayaran Rp. <span id='textPembayaran'></span></h4>
<h4>Kembalian Rp. <span id='textKembalian'></span></h4>

@foreach ($noPenjualan as $penjualan)
  <input type="hidden" id="noPenjualan" value="{{$penjualan->no_penjualan}}">
@endforeach


<hr>
<center>
  <h3>Total Penjualan Hari Ini <br>
      Rp. {{ number_format($tranSaksiHariIni , 0, '.', '.')}}
  </h3>
</center>
