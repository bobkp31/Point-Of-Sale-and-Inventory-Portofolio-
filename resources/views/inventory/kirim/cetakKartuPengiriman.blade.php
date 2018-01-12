@extends('pos.layouts.masterCetak')
<div class="row">
  <div class="col-md-12 panel-warning">
  	{{-- <div class="content-box-header panel-heading">
  	  <div class="panel-title ">Cetak Faktur</div>
  	</div> --}}

    <div class="content-box-large box-with-header">
      <div class="col-sm-6 col-md-6">
        <table class="table">
          <tr>
            <th>No Pengiriman</th>
            <th>:</th>
            <th> {{ $noPengiriman}}</th>
          </tr>
          <tr>
            <th>Waktu Pengiriman</th>
            <th>:</th>
            <th> {{ $detailPengiriman[0]->waktu}}</th>
          </tr>
        </table>
      </div>

      <table class="table table-bordered">
        <tr>
          <th>Barcode</th>
          <th>Nama Barang</th>
          <th>Jumlah Pengiriman</th>
        </tr>
        @foreach ($detailPengiriman as $barang)
          <tr>
            <td>{{ $barang->barcode }} </td>
            <td>{{ $barang->nama_barang }}</td>
            <td>{{ $barang->jumlah }}</td>
          </tr>
        @endforeach
      </table>
      <table width="100%" style="text-align:center">
        <tr>
          <td><h4>Petugas</h4></td>
          <td><h4>Pengirim</h4></td>
        </tr>
        <tr>
          <td>
              <h4>(-------------)</h4>
          </td>
          <td><h4>(-------------)</h4></td>
        </tr>
      </table>
    </div>
  </div>
</div>
