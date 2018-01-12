<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cetak Transaksi</title>
    <style media="screen">
      body {
        font-family: "Courier New";
      }
      .font-kasir {
        font-size : 11px;
      }
    </style>
  </head>
  <body>
    <center>
      ADITIYA MART <br>
      Jl. Taman Sari
    </center>
    <hr>
    <div class="font-kasir">
      <table>
        <tr>
          <td>NO</td>
          <td>:</td>
          <td >{{$noPenjualan}}</td>
          <td style="text-align:right"></td>
          <td></td>
          <td style="text-align:right">{{ $now=date('d-m-Y')}}</td>
        </tr>
        <tr>
          <td>Kasir</td>
          <td>:</td>
          <td>{{ session('username') }}</td>
          <td style="text-align:right"></td>
          <td></td>
          <td style="text-align:right">{{ $now=date('H:i:s')}}</td>
        </tr>
      </table>
      <hr>

      {{-- Transaksi  --}}
      <table>
        @foreach ($tbTransaksi as $transaksi)
          <tr>
            <td>{{ $transaksi->nama_barang }}</td>
            <td style="text-align:left">{{ $transaksi->qty }} x</td>
            <td>{{ number_format($transaksi->harga_jual, '0','.','.')}}</td>
            <td>{{ number_format($transaksi->subtotal, '0','.','.')}}</td>
          </tr>
        @endforeach
      </table>
      <hr>
      <table>
        @foreach ($detailTransaksi as $detail)
          <tr>
            <td>Total Item</td>
            <td></td>
            <td style="text-align:center" width="20%">{{ $detail->totalItem }} </td>
            <td>{{ number_format($detail->total,'0','.','.')}}</td>
          </tr>
        @endforeach

          <tr>
            <td>Total Potongan</td>
            <td></td>
            <td></td>
            <td>
              {{ number_format($totalDiskon,'0','.','.') }}
              {{-- {{ $detail2->total + $detailTransaksi[$key]->totalDiskon}} --}}
            </td>
          </tr>
        <tr>
          <td>Total Belanja</td>
          <td></td>
          <td></td>
          <td>{{ number_format($totalBayar[0]->total,'0','.','.') }}</td>
        </tr>
        <tr>
          <td>Tunai</td>
          <td></td>
          <td></td>
          <td>{{ number_format($totalBayar[0]->nominal_pembayaran,'0','.','.') }}</td>
        </tr>
        <tr>
          <td>kembalian</td>
          <td></td>
          <td></td>
          <td>{{ number_format($totalBayar[0]->nominal_pembayaran - $totalBayar[0]->total,'0','.','.')}}</td>
        </tr>
      </table>
      <hr>
      <center>
        TerimaKasih
      </center>
    </div>
  </body>
</html>
