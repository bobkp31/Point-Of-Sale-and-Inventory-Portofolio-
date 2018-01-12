@extends('pos.layouts.master')

@section('title','Laporan')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="content-box-large">

      <div class="row">

        <div class="col-md-3 ">
          <a href="/laporan/laporanPenjualan">
            <center>
              <div class="panel panel-primary">
                <p class="">
                  Laporan Penjualan
                </p>
                <div class="panel-heading">
                  <i class="fa fa-file fa-5x" aria-hidden="true"></i><br>
                </div>
              </div>
            </center>
          </a>
        </div>

        {{-- <div class="col-md-3 ">
          <a href="#">
            <center>
              <div class="panel panel-primary">
                <p class="">
                  Laporan Penjualan Item
                </p>
                <div class="panel-heading">
                   <i class="fa fa-cart-arrow-down fa-5x" aria-hidden="true"></i><br>
                </div>
              </div>
            </center>
          </a>
        </div> --}}
      </div>

    </div>
  </div>
</div>
@endsection
