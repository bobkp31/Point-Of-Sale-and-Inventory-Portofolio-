@extends('pos.layouts.master')

@section('title','Diskon')

@section('content')
<div class="row">
  <div class="col-md-12 panel-info jrk-marjin-bwh">
    <div class="content-box-header panel-heading">
      <div class="panel-title col-md-offset-5">
          <p class="text-center">Daftar Diskon</p>
      </div>
    </div>
  </div>
</div>


<div class="row">
	  <div class="col-md-4 panel-info">
			  <div class="content-box-header panel-heading">
		  		<div class="panel-title ">Tambah Diskon</div>

					<div class="panel-options">
						<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
						<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
					</div>
			  </div>

			  <div class="content-box-large box-with-header">
          <form id="formTambahDiskon">
						<div class="row">
                  {{-- Awal Form --}}
                  {{-- Column pertama  --}}
									<div class="col-sm-12">
                      <div class="form-group">
                        <label for="PilihDiskon">Pilih Diskon</label>
                        <div class="row">
                          <div class="col-xs-10">
                            <select id="jenisDiskon" class="form-control">
                              <option value="item" selected>Per-Item</option>
                              <option value="minimalN">Item Jumlah Minimal N</option>
                              {{-- <option value="diskonAB">Beli A Gratis B</option> --}}
                              <option value="penjualan">Penjualan</option>
                              {{-- <option value="pelangan">Pelangan</option> --}}
                            </select>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <div id="tampilJenisDiskon">

                      </div>

									</div>
						</div>
          </form>

				</div>
		</div>


    <div id="tabelDiskon">
    </div>

</div>


<!-- Modal diskon Item -->
<div class="modal fade" id="modalEditDiskonItem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
          Edit Diskon Item
        </h4>
      </div>

      <div class="modal-body">
        <!-- Begin Form -->
        <form method="post" class="form-horizontal" role="form" id="formEditDiskonItem">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" id="id" class="form-control" disabled>
          <div class="row container">
            <div class="col-md-12">


              <div class="form-group">
               <label for="diskon" class="control-label">Barcode</label>
               <div class="row">
                 <div class="col-sm-4">
                   <input type="text" id="editBarcode" class="form-control" disabled>
                 </div>
               </div>
              </div>

              <div class="form-group">
               <label for="namaBarang" class="control-label">Nama Barang</label>
               <div class="row">
                 <div class="col-sm-4">
                   <input type="text" id="editNamaBarang" class="form-control" disabled>
                 </div>
               </div>
              </div>

              <div class="form-group">
                <label for="hargaJual" class="control-label">Harga Jual</label>
                <div class="row">
                  <div class="col-sm-4">
                    <input type="text" id="editHargaJual" class="form-control" disabled>
                  </div>
                </div>
              </div>


              <div class="form-group">
               <label for="diskon" class="control-label">Mendapatkan Diskon</label>
               <div class="row">
               </div>

                 <div class="col-sm-1">
                   <select id="editJenisNilai" class="form-control">
                     <option value="persentase">%</option>
                     <option value="rupiah">Rp.</option>
                   </select>
                 </div>
                 <div class="col-sm-3">
                   <input type="text" id="editNilaiDiskon" class="form-control">
                 </div>
               </div>

             <div class="form-group">
               <label for="hargaSetelahDiskon" class="control-label">Harga Setelah Diskon</label>
               <div class="row">
                 <div class="col-sm-4">
                   <input type="text" id="editHargaSetelahDiskon" class="form-control" disabled>
                 </div>
               </div>
             </div>

             <div class="form-group">
               <label for="tanggalMulai" class="control-label">Berlaku</label>
               <div class="row">
                 <div class="col-sm-2">
                     <input type="date" id="editTanggalMulai" class="form-control">
                 </div>
                 <div class="col-sm-2">
                   <input type="time" id="editJamMulai" class="form-control">
                 </div>
               </div>
             </div>

             <div class="form-group">
               <label for="tanggalMulai" class="control-label">Berakhir</label>
               <div class="row">
                 <div class="col-sm-2">
                     <input type="date" id="editTanggalBerakhir" class="form-control">
                 </div>
                 <div class="col-sm-2">
                   <input type="time" id="editJamBerakhir" class="form-control">
                 </div>
               </div>
             </div>

             <div class="form-group">
               <button type="button" id="btn-editDiskonItem" class="btn btn-primary" data-dismiss="modal">
                 Edit
               </button>
             </div>
            </div>
          </div>

        </form>
        <!-- End Form -->
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>

    </div>
  </div>
</div>
<!-- End Modal Edit Diskon Item -->



<script type="text/javascript">
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

//Memilih Form Diskon
var jenisDiskon = $('#jenisDiskon').val();
if (jenisDiskon == 'item'){
  $.ajax({
    url     : '/pos/diskon/formDiskonItem',
    method  : 'get',
    success : function(response){
      $('#tampilJenisDiskon').html(response);
    }
  })

  //tampilkan tabel diskon Item
  $.ajax({
    url     : '/pos/diskon/tabelDiskonItem',
    method  : 'get',
    success : function(response){
      $('#tabelDiskon').html(response);
    }
  })
}

//memilih form Diskon
$('#jenisDiskon').change(function(){
  var jenisDiskon = $('#jenisDiskon').val();
  if (jenisDiskon == 'item'){

    //tampil From diskon Item
    $.ajax({
      url     : '/pos/diskon/formDiskonItem',
      method  : 'get',
      success : function(response){
        $('#tampilJenisDiskon').html(response);
      }
    })

    //tampilkan tabel diskon Item
    $.ajax({
      url     : '/pos/diskon/tabelDiskonItem',
      method  : 'get',
      success : function(response){
        $('#tabelDiskon').html(response);
      }
    })
  }else if(jenisDiskon == 'penjualan'){
    //tampil form diskon penjualan
    $.ajax({
      url     : '/pos/diskon/formDiskonPenjualan',
      method  : 'get',
      success : function(response){
        $('#tampilJenisDiskon').html(response);
      }
    })

    //tampil tabel diskon penjualan
    $.ajax({
      url     : '/pos/diskon/tabelDiskonPenjualan',
      method  : 'get',
      success : function(response){
        $('#tabelDiskon').html(response);
      }
    })


  }else if(jenisDiskon == 'diskonAB'){
    //tampil form diskon AB
    $.ajax({
      url     : '/pos/diskon/formDiskonAB',
      method  : 'get',
      success : function(response){
        $('#tampilJenisDiskon').html(response);
      }
    })

    //tampil tabel diskon AB
    $.ajax({
      url     : '/pos/diskon/tabelDiskonAB',
      method  : 'get',
      success : function(response){
        $('#tabelDiskon').html(response);
      }
    })
  }else if(jenisDiskon == 'minimalN'){
    //Tampil form diskon Jumlah Minimal N
    $.ajax({
      url     : '/pos/diskon/formDiskonJumlahMinimalN',
      method  : 'get',
      success : function(response){
        $('#tampilJenisDiskon').html(response);
      }
    })

    $.ajax({
      url     : '/pos/diskon/tabelJumlahMinimalN',
      method  : 'get',
      success : function(response){
        $('#tabelDiskon').html(response);
      }
    })

  }
})

//Edit Diskon
$('#btn-editDiskonItem').click(function(){
  var id = $('#id').val();
  var jenisNilai = $('#editJenisNilai').val();
  var hargaJual = $('#editHargaJual').val();
  var nilaiDiskon = $('#editNilaiDiskon').val();
  var hargaSetelahDiskon = $('#editHargaSetelahDiskon').val();
  var tanggalBerlaku = $('#editTanggalMulai').val();
  var jamBerlaku = $('#editJamMulai').val();
  var tanggalBerakhir = $('#editTanggalBerakhir').val();
  var jamBerakhir = $('#editJamBerakhir').val();

  $.ajax({
    url : '/pos/diskon/editDiskonItem',
    method   : 'get',
    data     : {'id' : id, 'hargaJual' : hargaJual,
                'jenisNilai' : jenisNilai,'nilaiDiskon' : nilaiDiskon,
                'hargaSetelahDiskon' : hargaSetelahDiskon, 'tanggalBerlaku' : tanggalBerlaku,
                'tanggalBerakhir' : tanggalBerakhir,
                'jamBerlaku' : jamBerlaku, 'jamBerakhir' : jamBerakhir},
    success  : function(response){
      console.log(response);
      $('#tabelDiskon').load('/pos/diskon/tabelDiskonItem');
      $('#formEditDiskonItem').trigger('reset');
    }
  })
});
</script>
@endsection
