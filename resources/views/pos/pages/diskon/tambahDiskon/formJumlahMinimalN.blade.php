<div class="form-group">
 <label for="diskon" class="control-label">Barcode</label>
 <div class="row">
   <div class="col-sm-6">
     <input type="text" id="barcode" class="form-control">
   </div>
   <div class="col-sm-2">
     <button type="button" class="btn btn-primary" id="btn-cariBarcode">
       cari
     </button>
   </div>
 </div>
</div>

<div class="form-group">
 <label for="hargaJual" class="control-label">HargaJual</label>
 <div class="row">
   <div class="col-sm-6">
     <input type="text" id="hargaJual" class="form-control" disabled="disabled">
   </div>
 </div>
</div>

<div class="form-group">
  <label for="diskon" class="control-label">Jika Konsumen Membeli</label>
  <div class="row">

    <div class="col-sm-3">
      <input type="text" id="qtyPembelian" class="form-control">
    </div>

    <div class="col-sm-3">
      <input type="text" class="form-control" value="X" disabled="disabled">
    </div>

    <div class="col-sm-6">
      <input type="text" id="namaBarang" class="form-control" disabled="disabled">
    </div>
  </div>
</div>

<div class="form-group">
  <label for="diskon" class="control-label">Dapat Diskon</label>
  <div class="row">
    <div class="col-sm-4">
      <select id="jenisNilai" class="form-control">
        <option value="persentase">%</option>
        <option value="rupiah">Rp.</option>
      </select>
    </div>

    <div class="col-sm-8">
      <input type="text" id="nilai" class="form-control">
    </div>
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
      <button type="button" class="btn btn-primary" id="btn-tambahDiskonMinimalN">
        Tambah
      </button>
    </div>
  </div>
</div>

<!-- Modal Edit Diskon Minimal N -->
<div class="modal fade" id="modalEditDiskonMinimumN" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
          Edit Diskon Penjualan
        </h4>
      </div>

      <div class="modal-body">
        <!-- Begin Form -->
        <form>
          <input type="hidden" id="editId" class="form-control">
          {{-- <div class="form-group">
           <label for="diskon" class="control-label">Barcode</label>
           <div class="row">
             <div class="col-sm-6">
               <input type="text" id="barcode" class="form-control">
             </div>
             <div class="col-sm-2">
               <button type="button" class="btn btn-primary" id="btn-cariBarcode">
                 cari
               </button>
             </div>
           </div>
          </div> --}}

          <div class="form-group">
           <label for="editHargaJual" class="control-label">HargaJual</label>
           <div class="row">
             <div class="col-sm-6">
               <input type="text" id="editHargaJual" class="form-control" disabled="disabled">
             </div>
           </div>
          </div>

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
                <input type="text" id="editNamaBarang" class="form-control" disabled="disabled">
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="diskon" class="control-label">Dapat Diskon</label>
            <div class="row">
              <div class="col-sm-3">
                <select id="editJenisNilai" class="form-control">
                  <option value="persentase">%</option>
                  <option value="rupiah">Rp.</option>
                </select>
              </div>

              <div class="col-sm-8">
                <input type="text" id="editNilai" class="form-control">
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
            <label for="editTanggalBerakhir" class="control-label">Tanggal Berakhir</label>
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
                <button type="button" class="btn btn-primary"
                        id="btn-editDiskonMinimalN"
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
<!-- End Edit Diskon Minimal N -->



<script type="text/javascript">
//Cari Barcode
$('#btn-cariBarcode').click(function(){
  var barcodeB = $('#barcode').val();
  // 1. cari barcode B
  $.ajax({
    url     : '/pos/diskon/cariBarcode',
    method  : 'get',
    data    : {'barcode' : barcodeB},
    success : function(response){
      $('#namaBarang').val(response[0].nama_barang);
      $('#hargaJual').val(response[0].harga_jual);
    }
  })
})


//checkbox kelipatan
$('input[type="checkbox"]').click(function(){
    if($(this).is(":checked")){
        $(this).val('ya');
    }
    else if($(this).is(":not(:checked)")){
        $(this).val('tidak');
    }
});

//Tambah Diskon
$('#btn-tambahDiskonMinimalN').click(function(){

  var barcode     = $('#barcode').val();
  var hargaJual   = $('#hargaJual').val();
  var namaBarang  = $('#namaBarang').val();
  var qtyPembelian = $('#qtyPembelian').val();
  var jenisNilai  = $('#jenisNilai').val();
  var nilaiDiskon = $('#nilai').val();
  var kelipatan   = $('#kelipatan').val();
  var tanggalBerlaku    = $('#tanggalBerlaku').val();
  var jamBerlaku        = $('#jamBerlaku').val();
  var tanggalBerakhir = $('#tanggalBerakhir').val();
  var jamBerakhir     = $('#jamBerakhir').val();

  // console.log(barcode + namaBarang + qtyPembelian + jenisNilai + nilaiDiskon + tanggalBerlaku + jamBerlaku + tanggalBerakhir + tanggalBerakhir + kelipatan)
  $.ajax({
    url     : '/pos/diskon/tambahDiskonMinimalN',
    method  : 'get',
    data    : {'barcode' : barcode,'namaBarang' : namaBarang,'hargaJual' : hargaJual,
               'qtyPembelian' : qtyPembelian, 'jenisNilai' : jenisNilai,
               'kelipatan' : kelipatan,'nilaiDiskon' : nilaiDiskon,
               'tanggalBerlaku' : tanggalBerlaku, 'jamBerlaku' : jamBerlaku,
               'tanggalBerakhir' : tanggalBerakhir, 'jamBerakhir' : jamBerakhir},
    success : function(response){
      // console.log(response);
      $('#formTambahDiskon').trigger('reset');
      $('#tabelDiskon').load('/pos/diskon/tabelJumlahMinimalN');
    }
  })

})

//Edit Diskon Minimum N
$('#btn-editDiskonMinimalN').click(function(){
  var id = $('#editId').val();
  var namaBarang = $('#editNamaBarang').val();
  var hargaJual = $('#editHargaJual').val();
  var qtyPembelian = $('#editQtyPembelian').val();
  var nilaiDiskon = $('#editNilai').val();
  var kelipatan  = $('#editKelipatan').val();
  var jenisNilai = $('#editJenisNilai').val();
  var tanggalBerlaku = $('#editTanggalBerlaku').val();
  var tanggalBerakhir = $('#editTanggalBerakhir').val();

  var jamBerlaku = $('#editJamBerlaku').val();
  var jamBerakhir = $('#editJamBerakhir').val();

  // console.log(hargaJual);
  // console.log(id + namaBarang + hargaJual + qtyPembelian + nilai + tanggalBerlaku +
              // tanggalBerakhir + jamBerlaku + jambBerakhir + kelipatan + jenisNilai);

  $.ajax({
    url     : '/pos/diskon/editDiskonMinimumN',
    method  : 'get',
    data    : {'id' : id,
               'namaBarang' : namaBarang,
               'hargaJual' : hargaJual,
               'qtyPembelian' : qtyPembelian,
               'jenisNilai' : jenisNilai,
               'kelipatan' : kelipatan,
               'nilaiDiskon' : nilaiDiskon,
               'tanggalBerlaku' : tanggalBerlaku,
               'tanggalBerakhir' : tanggalBerakhir,
               'jamBerlaku' : jamBerlaku,
               'jamBerakhir' : jamBerakhir
            },
    success : function(response){
      $('#tabelDiskon').load('/pos/diskon/tabelJumlahMinimalN');
      }
    })
})

</script>
