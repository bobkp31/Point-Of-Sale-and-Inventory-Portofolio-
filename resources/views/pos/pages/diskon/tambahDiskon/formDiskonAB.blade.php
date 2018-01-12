<div class="form-group">
 <label for="diskon" class="control-label">Barcode A</label>
 <div class="row">
   <div class="col-sm-6">
     <input type="text" id="barcodeA" class="form-control">
   </div>
   <div class="col-sm-2">
     <button type="button" class="btn btn-primary" id="btn-cariBarcodeA">
       cari
     </button>
   </div>
 </div>
</div>

<div class="form-group">
 <label for="diskon" class="control-label">Barcode B</label>
 <div class="row">
   <div class="col-sm-6">
     <input type="text" id="barcodeB" class="form-control">
   </div>
   <div class="col-sm-2">
     <button type="button" class="btn btn-primary" id="btn-cariBarcodeB">
       cari
     </button>
   </div>
 </div>
</div>
<hr>

<div class="form-group">
  <label for="diskon" class="control-label">Jika Konsumen Membeli</label>
  <div class="row">

    <div class="col-sm-2">
      <input type="text" id="qtyPembelian" class="form-control">
    </div>

    <div class="col-sm-2">
      <input type="text" class="form-control" value="X" disabled="disabled">
    </div>

    <div class="col-sm-8">
      <input type="text" id="namaBarangA" class="form-control" disabled="disabled">
    </div>
  </div>
</div>

<div class="form-group">
  <label for="diskon" class="control-label">Dapat Gratis</label>
  <div class="row">
    <div class="col-sm-2">
      <input type="text" id="qtyBonus" class="form-control">
    </div>
    <div class="col-sm-2">
      <input type="text" class="form-control" value="X" disabled="disabled">
    </div>
    <div class="col-sm-8">
      <input type="text" id="namaBarangB" class="form-control" disabled="disabled">
    </div>
  </div>

  <div class="checkbox">
     <label class="control-label">
       Berlaku Kelipan
     </label>
     <input type="checkbox" id="kelipatan">
   </div>

</div>

<hr>

<div class="form-group">
  <label for="tanggalMulai" class="control-label">Tanggal Mulai</label>
  <div class="row">
    <div class="col-sm-6">
        <input type="date" id="tanggalBerlaku" class="form-control">
    </div>
    <div class="col-sm-6">
      <input type="time" id="jamBerlaku" class="form-control">
    </div>
  </div>
</div>


<div class="form-group">
  <label for="tanggalBerakhir" class="control-label">Tanggal Berakhir</label>
  <div class="row">
    <div class="col-sm-6">
      <input type="date" id="tanggalBerakhir" class="form-control">
    </div>
    <div class="col-sm-6">
      <input type="time" id="jamBerakhir" class="form-control">
    </div>
  </div>
</div>

<hr>
<div class="form-group">
  <div class="row">
    <div class=" col-sm-8">
      <button type="button" class="btn btn-primary" id="btn-tambahDiskonAB">
        Tambah
      </button>
    </div>
  </div>
</div>

<!-- Modal Edit Diskon AB -->
<div class="modal fade" id="modalEditDiskonAB" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
          Edit Diskon AB
        </h4>
      </div>

      <div class="modal-body">
        <!-- Begin Form -->
        <form>
          <input type="hidden" id="editId" class="form-control">

          {{-- <div class="form-group">
           <label for="diskon" class="control-label">Barcode A</label>
           <div class="row">
             <div class="col-sm-6">
               <input type="text" id="barcodeA" class="form-control" disabled="disabled">
             </div>
             <div class="col-sm-2">
               <button type="button" class="btn btn-primary" id="btn-cariBarcodeA">
                 cari
               </button>
             </div>
           </div>
          </div>

          <div class="form-group">
           <label for="diskon" class="control-label">Barcode B</label>
           <div class="row">
             <div class="col-sm-6">
               <input type="text" id="barcodeB" class="form-control" disabled="disabled">
             </div>
             <div class="col-sm-2">
               <button type="button" class="btn btn-primary" id="btn-cariBarcodeB">
                 cari
               </button>
             </div>
           </div>
          </div>
          <hr> --}}

          <div class="form-group">
            <label for="diskon" class="control-label">Jika Konsumen Membeli</label>
            <div class="row">

              <div class="col-sm-2">
                <input type="text" id="editQtyPembelian" class="form-control">
              </div>

              <div class="col-sm-2">
                <input type="text" class="form-control" value="X" disabled="disabled">
              </div>

              <div class="col-sm-8">
                <input type="text" id="editNamaBarangA" class="form-control" disabled="disabled">
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="diskon" class="control-label">Dapat Gratis</label>
            <div class="row">
              <div class="col-sm-2">
                <input type="text" id="editQtyBonus" class="form-control">
              </div>
              <div class="col-sm-2">
                <input type="text" class="form-control" value="X" disabled="disabled">
              </div>
              <div class="col-sm-8">
                <input type="text" id="editNamaBarangB" class="form-control" disabled="disabled">
              </div>
            </div>

            <div class="checkbox">
               <label class="control-label">
                 Berlaku Kelipan
               </label>
               <input type="checkbox" id="editKelipatan">
             </div>

          </div>

          <hr>

          <div class="form-group">
            <label for="tanggalMulai" class="control-label">Tanggal Mulai</label>
            <div class="row">
              <div class="col-sm-6">
                  <input type="date" id="editTanggalBerlaku" class="form-control">
              </div>
              <div class="col-sm-6">
                <input type="time" id="editJamBerlaku" class="form-control">
              </div>
            </div>
          </div>


          <div class="form-group">
            <label for="tanggalBerakhir" class="control-label">Tanggal Berakhir</label>
            <div class="row">
              <div class="col-sm-6">
                <input type="date" id="editTanggalBerakhir" class="form-control">
              </div>
              <div class="col-sm-6">
                <input type="time" id="editJamBerakhir" class="form-control">
              </div>
            </div>
          </div>

          <hr>
          <div class="form-group">
            <div class="row">
              <div class=" col-sm-8">
                <button type="button"
                        class="btn btn-primary"
                        id="btn-editDiskonAB"
                        data-dismiss="modal">
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
<!-- End Modal Edit Diskon AB -->


<script type="text/javascript">
  //checkbox kelipatan
  $('input[type="checkbox"]').click(function(){
      if($(this).is(":checked")){
          $(this).val('ya');
      }
      else if($(this).is(":not(:checked)")){
          $(this).val('tidak');
      }
  });

  //Cari Barcode A
  $('#btn-cariBarcodeA').click(function(){
      var barcodeA = $('#barcodeA').val();

      // 1. cari barcode A
      $.ajax({
        url     : '/pos/diskon/cariBarcode',
        method  : 'get',
        data    : {'barcode' : barcodeA},
        success : function(response){
          // console.log(response);
          $('#namaBarangA').val(response[0].nama_barang);
        }
      })
  })

  //Cari Barcode B
  $('#btn-cariBarcodeB').click(function(){
    var barcodeB = $('#barcodeB').val();
    // 1. cari barcode B
    $.ajax({
      url     : '/pos/diskon/cariBarcode',
      method  : 'get',
      data    : {'barcode' : barcodeB},
      success : function(response){
        $('#namaBarangB').val(response[0].nama_barang);
      }
    })
  })

  //Tambah Diskon AB
  $('#btn-tambahDiskonAB').click(function(){
    var barcodeA     = $('#barcodeA').val();
    var barcodeB     = $('#barcodeB').val();
    var namaBarangB  = $('#namaBarangB').val();
    var qtyPembelian = $('#qtyPembelian').val();
    var qtyBonus     = $('#qtyBonus').val();
    var kelipatan    = $('#kelipatan').val();
    var tanggalBerlaku    = $('#tanggalBerlaku').val();
    var jamBerlaku        = $('#jamBerlaku').val();
    var tanggalBerakhir = $('#tanggalBerakhir').val();
    var jamBerakhir     = $('#jamBerakhir').val();

    // alert(barcodeA +' '+ barcodeB+' '+qtyPembelian+' '+qtyBonus+' '+kelipatan+' '+tanggalMulai+' '+tanggalBerakhir+' '+jamMulai+' '+jamBerakhir);

    $.ajax({
      url     : '/pos/diskon/tambahDiskonAB',
      method  : 'get',
      data    : {'barcodeA' : barcodeA, 'barcodeB' : barcodeB,'namaBarangB' : namaBarangB,
                 'qtyPembelian' : qtyPembelian, 'qtyBonus' : qtyBonus,
                 'kelipatan' : kelipatan,
                 'tanggalBerlaku' : tanggalBerlaku, 'jamBerlaku' : jamBerlaku,
                 'tanggalBerakhir' : tanggalBerakhir, 'jamBerakhir' : jamBerakhir },
      success : function(response){
        console.log(response);
        $('#formTambahDiskon').trigger('reset');
        $('#tabelDiskon').load('/pos/diskon/tabelDiskonAB');
      }
    })
  })

  //Edit diskon AB
  $('#btn-editDiskonAB').click(function(){
    var id = $('#editId').val();
    var qtyPembelian = $('#editQtyPembelian').val();
    var qtyBonus = $('#editQtyBonus').val();
    var kelipatan = $('#editKelipatan').val();
    var tanggalBerlaku = $('#editTanggalBerlaku').val();
    var tanggalBerakhir = $('#editTanggalBerakhir').val();

    var jamBerlaku = $('#editJamBerlaku').val();
    var jamBerakhir = $('#editJamBerakhir').val();

    // console.log(id + qtyPembelian + qtyBonus + kelipatan + tanggalBerlaku + tanggalBerakhir + jamBerakhir + jamBerlaku);

    $.ajax({
      url     : '/pos/diskon/editDiskonAB',
      method  : 'get',
      data    : {'id' : id,'qtyPembelian' : qtyPembelian,
                 'qtyBonus' : qtyBonus, 'kelipatan' : kelipatan,
                 'tanggalBerlaku' : tanggalBerlaku, 'jamBerlaku' : jamBerlaku,
                 'tanggalBerakhir' : tanggalBerakhir, 'jamBerakhir' : jamBerakhir },
      success : function(response){
        // console.log(response);
        // $('#formTambahDiskon').trigger('reset');
        $('#tabelDiskon').load('/pos/diskon/tabelDiskonAB');
      }
    })

  })
</script>
