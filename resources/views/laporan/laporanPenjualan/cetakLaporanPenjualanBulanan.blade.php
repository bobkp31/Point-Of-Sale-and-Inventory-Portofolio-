@extends('pos.layouts.masterCetak')
<div class="row">
  <div class="col-md-8">
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


<div class="row">
  <div class="col-md-10">
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
