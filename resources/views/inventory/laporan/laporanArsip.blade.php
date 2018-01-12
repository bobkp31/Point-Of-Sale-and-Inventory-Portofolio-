@extends('pos.layouts.master')

@section('title','Laporan')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="content-box-large">

      <div class="row">

        <div class="col-md-3 ">
          <a href="/inventory/laporan/laporanPengiriman">
            <center>
              <div class="panel panel-primary">
                <p class="">
                  Pengiriman
                </p>
                <div class="panel-heading">
                  <i class="fa fa-truck fa-5x" aria-hidden="true"></i><br>
                </div>
              </div>
            </center>
          </a>
        </div>


      </div>

    </div>
  </div>
</div>
@endsection
