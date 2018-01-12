<form class="form-horizontal" id="formTambahKategori">
  <div class="form-group">
    <label for="kategori" class="col-sm-2 control-label">Kategori</label>
    <div class="col-sm-10">
      <span id="pemberitahuanInputEditKategori"> </span>
      <input type="text"
             class="form-control"
             id="editKategori"
             value="{{ $kategori[0]->kategori }}">

      <input type="hidden" class="form-control" id="idKategori"
                    value="{{ $kategori[0]->id }}">

    </div>

  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
       <button type="button"
               class="btn btn-success
               btn-sm" id="btn-editKategori">
          Edit
        </button>
    </div>
  </div>
</form>
<script type="text/javascript">
  $('#btn-editKategori').click(function(){
    var idKategori = $('#idKategori').val();
    var kategori = $('#editKategori').val();
      $.ajax({
        url  : '/inventory/barang/editKategori',
        method : 'get',
        data   : {'idKategori' : idKategori,
                  'kategori'   : kategori},
        success : function(response){
          if(response == 'kosong'){
            $('#pemberitahuanInputEditKategori').text('Tidak Boleh Kosong !');
          }else if (response == 'ok') {
            $('#modalTabelKategori').load('/inventory/barang/tabelKategori');
          }
        }
      })
  })
</script>
