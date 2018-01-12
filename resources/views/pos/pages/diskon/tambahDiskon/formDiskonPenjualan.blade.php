
<div class="form-group">
  <label for="minimumPembelian" class="control-label">Jumlah Minimum Pembelian</label>
  <div class="row">
    <div class="col-sm-10">
      <input type="text" id="minimumPembelian" class="form-control">
    </div>
  </div>
</div>

<div class="form-group">
  <label for="Besardiskon" class="control-label">Mendapatkan Diskon</label>
  <div class="row">
    <div class="col-sm-4">
      <select id="nilaiDiskon" class="form-control">
        <option value="persentase">%</option>
        <option value="rupiah">Rp.</option>
      </select>
    </div>
    <div class="col-sm-6">
      <input type="text" id="nilai" class="form-control">
    </div>
  </div>
</div>

<div class="form-group">
  <label for="Besardiskon" class="control-label">Tanggal Berlaku</label>
  <div class="row">
    <div class="col-sm-6">
      <input type="date" id="tanggalBerlaku" class="form-control">
    </div>
    <div class="col-sm-5">
      <input type="time" id="jamBerlaku" class="form-control">
    </div>
  </div>
</div>

<div class="form-group">
  <label for="Besardiskon" class="control-label">Tanggal Berakhir</label>
  <div class="row">
    <div class="col-sm-6">
      <input type="date" id="tanggalBerakhir" class="form-control">
    </div>
    <div class="col-sm-5">
      <input type="time" id="jamBerakhir" class="form-control">
    </div>
  </div>
</div>

<div class="form-group">
  <div class="row">
    <div class="col-sm-8">
      <button class="btn btn-primary" id="btn-tambahDiskonPenjualan">
        Tambah
      </button>
    </div>
  </div>
</div>


<!-- Modal Edit Diskon Penjualan -->
<div class="modal fade" id="modalEditDiskonPenjualan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
          <div class="form-group">
            <label for="minimumPembelian" class="control-label">Jumlah Minimum Pembelian</label>
            <div class="row">
              <div class="col-sm-10">
                <input type="text" id="editMinimumPembelian" class="form-control">
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="Besardiskon" class="control-label">Mendapatkan Diskon</label>
            <div class="row">
              <div class="col-sm-4">
                <select id="EditNilaiDiskon" class="form-control">
                  <option value="persentase" id='op1'>%</option>
                  <option value="rupiah" id='op2' >Rp.</option>
                </select>
              </div>
              <div class="col-sm-6">
                <input type="text" id="EditNilai" class="form-control">
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="Besardiskon" class="control-label">Tanggal Berlaku</label>
            <div class="row">
              <div class="col-sm-6">
                <input type="date" id="EditTanggalBerlaku" class="form-control">
              </div>
              <div class="col-sm-5">
                <input type="time" id="EditJamBerlaku" class="form-control">
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="Besardiskon" class="control-label">Tanggal Berakhir</label>
            <div class="row">
              <div class="col-sm-6">
                <input type="date" id="EditTanggalBerakhir" class="form-control">
              </div>
              <div class="col-sm-5">
                <input type="time" id="EditJamBerakhir" class="form-control">
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-sm-8">
                <button class="btn btn-primary" id="btn-EditDiskonPenjualan" data-dismiss="modal">
                  edit
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
<!-- End Modal Tambah Produk -->



<script type="text/javascript">
  //Tambah Diskon
  $('#btn-tambahDiskonPenjualan').click(function(e){
    e.preventDefault();
    var minimumPembelian = $('#minimumPembelian').val();
    var nilaiDiskon      = $('#nilaiDiskon').val();
    var nilai            = $('#nilai').val();
    var tanggalBerlaku   = $('#tanggalBerlaku').val();
    var tanggalBerakhir  = $('#tanggalBerakhir').val();
    var jamBerlaku       = $('#jamBerlaku').val();
    var jamBerakhir      = $('#jamBerakhir').val();

    // alert(minimumPembelian + nilaiDiskon + nilai + tanggalBerlaku + tanggalBerakhir + jamBerlaku + jamBerakhir);
    $.ajax({
      url    : '/pos/diskon/tambahDiskonPenjualan',
      method : 'get',
      data : { 'minimumPembelian' : minimumPembelian, 'nilaiDiskon' : nilaiDiskon,
               'nilai' : nilai, 'tanggalBerlaku' : tanggalBerlaku,
               'tanggalBerakhir' : tanggalBerakhir, 'jamBerlaku' : jamBerlaku,
               'jamBerakhir' : jamBerakhir
             },
      success : function(response){
        //console.log(response);
        $('#formTambahDiskon').trigger('reset');
        $('#tabelDiskon').load('/pos/diskon/tabelDiskonPenjualan');
      }
    })

  })




  //Edit Diskon Penjualan
  $('#btn-EditDiskonPenjualan').click(function(e){
    e.preventDefault();
    var id = $('#editId').val();
    var minimumPembelian = $('#editMinimumPembelian').val();
    var nilaiDiskon = $('#EditNilaiDiskon').val();
    var nilai = $('#EditNilai').val();
    var tanggalBerlaku  = $('#EditTanggalBerlaku').val();
    var tanggalBerakhir = $('#EditTanggalBerakhir').val();
    var jamBerlaku  = $('#EditJamBerlaku').val();
    var jamBerakhir = $('#EditJamBerakhir').val();

    // console.log(minimumPembelian+nilaiDiskon+nilai+tanggalBerlaku+tanggalBerakhir+jamBerlaku+jamBerakhir);
    $.ajax({
      url    :  '/pos/diskon/editDiskonPenjualan',
      method : 'get',
      data   : { 'id'               : id,
                 'minimumPembelian' : minimumPembelian,
                 'nilaiDiskon'      : nilaiDiskon,
                 'nilai'            : nilai,
                 'tanggalBerlaku'   : tanggalBerlaku,
                 'tanggalBerakhir'  : tanggalBerakhir,
                 'jamBerlaku'       : jamBerlaku,
                 'jamBerakhir'      : jamBerakhir
                },
      success : function(response){
        //console.log(response);
        $('#tabelDiskon').load('/pos/diskon/tabelDiskonPenjualan');

      }
    })

  })
</script>
