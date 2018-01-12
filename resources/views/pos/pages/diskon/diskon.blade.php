@extends('pos.layouts.master')

@section('title','Diskon')

@section('content')
<div class="row">
  <div class="col-md-12 panel-primary jrk-marjin-bwh">
    <div class="content-box-header panel-heading">
      <div class="panel-title col-md-offset-5">
          <p class="text-center">Daftar Diskon</p>
      </div>
    </div>
  </div>
</div>

<!-- Tambah Diskon -->
<div class="row jrk-marjin-bwh">
  <div class="col-md-3">
    <button class="btn btn-warning" type="button" name="tmbhDiskonItem">Tambah Diskon Item</button>
  </div>

  <div class="col-md-3">
    <button class="btn btn-warning" type="button" name="tmbhDiskonPemasok">Tambah Diskon Pemasok</button>
  </div>

  <div class="col-md-3">
    <button class="btn btn-warning" type="button" name="tmbhDiskonPenjualan">Tambah Diskon Penjualan</button>
  </div>

  <div class="col-md-3">
    <button class="btn btn-warning" type="button" name="tmbhDiskonPelanggan">Tambah Diskon Pelanggan</button>
  </div>
</div>


<div class="row">
  <!-- Diskon Per Item -->
  <div class="col-md-6 panel-warning">
    <div class="content-box-header panel-heading">
      <div class="panel-title">Diskon Item</div>
    </div>

    <div class="content-box-large">
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <tr>
              <th>Nama Diskon</th>
              <th>Diskon</th>
              <th>Berlaku</th>
            </tr>
            <tr>
              <th>Diskon item Ramadhan</th>
              <th>10%</th>
              <th>2017-07-02 sampai 2017-08-02</th>
            </tr>
          </table>
        </div>
      </div>
    </div>
    </div>
  <!-- Akhir Diskon Per Item -->

  <!-- Diskon Per Pemasok -->
  <div class="col-md-6 panel-warning">
    <div class="content-box-header panel-heading">
      <div class="panel-title">Diskon Pemasok</div>
    </div>

    <div class="content-box-large">
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <tr>
              <th>Nama Diskon</th>
              <th>Diskon</th>
              <th>Berlaku</th>
            </tr>
            <tr>
              <th>Diskon Pemasok PT.Belum Jadi</th>
              <th>9%</th>
              <th>2017-07-02 sampai 2017-08-02</th>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- Akhir Diskon Per Pemasok -->
</div>

<div class="row">
  <!-- Diskon Penjualan -->
  <div class="col-md-6 panel-warning">
    <div class="content-box-header panel-heading">
      <div class="panel-title">Diskon Penjualan</div>
    </div>

    <div class="content-box-large">
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <tr>
              <th>Nama Diskon</th>
              <th>Diskon</th>
              <th>Berlaku</th>
            </tr>
            <tr>
              <th>Diskon Penjualan < Rp.100.000</th>
              <th>10%</th>
              <th>2017-07-02 sampai 2017-08-02</th>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- Akhir Diskon Penjualan -->

  <!-- Diskon Pelanggan -->
  <div class="col-md-6 panel-warning">
    <div class="content-box-header panel-heading">
      <div class="panel-title">Diskon Pelanggan</div>
    </div>

    <div class="content-box-large">
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <tr>
              <th>Nama Diskon</th>
              <th>Diskon</th>
              <th>Berlaku</th>
            </tr>
            <tr>
              <th>Diskon Pelanggan 1000 point</th>
              <th>9%</th>
              <th>2017-07-02 sampai 2017-08-02</th>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- Akhir Diskon Per Pemasok -->
</div>


@endsection
