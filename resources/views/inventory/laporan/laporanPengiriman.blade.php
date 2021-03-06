@extends('pos.layouts.master')

@section('title','Laporan Pengiriman')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="content-box-large">

      <div class="row">
        <div class="col-md-6">
          <div class="btn-group-md jrk-marjin-bwh">
            <button type="button"
                    class="btn btn-primary"
                    id="btnLaporanHarian">
              harian
            </button>

            <button type="button"
                    class="btn btn-primary"
                    id="btnLaporanBulanan">
              bulanan
            </button>


          </div>
        </div>
      </div>

      <div id="tampilForm">

      </div>


      <div id="tampilLaporanPengiriman">
      </div>

    </div>
  </div>
</div>



<script type="text/javascript">
  // menampilkan form input harian
  $('#tampilForm').load('/laporan/formHarian');

  // menampilkan form input harian ketika button harian di klik
  $('#btnLaporanHarian').click(function(){
      $('#tampilForm').load('/laporan/formHarian');
      $('#tampilLaporan').show();
  })

  // menampilkan form input bulanan ketika button bulanan di klik
  $('#btnLaporanBulanan').click(function(){
      $('#tampilForm').load('/laporan/formBulanan');
      $('#tampilLaporan').hide();
  })

  //melihat laporan harian
  function pilihHari(){
    var hari = $('#hari').val();
    // console.log(hari);
    $.ajax({
      url : '/inventory/laporan/laporanPengirimanHarian',
      method : 'get',
      data   : {'hari':hari},
      success : function(response){
        console.log(response);
        $('#tampilLaporanPengiriman').html(response);
      }
    })
  }

  //melihat laporan Bulanan
  function pilihBulan(){
    var bulan = $('#bulan').val();
    $.ajax({
      url : '/inventory/laporan/laporanPengirimanBulanan',
      method : 'get',
      data   : {'bulan':bulan},
      success : function(response){
        console.log(response);
        // $('#tampilLaporan').show();
        $('#tampilLaporanPengiriman').html(response);
      }
    })
  }

</script>
@endsection
