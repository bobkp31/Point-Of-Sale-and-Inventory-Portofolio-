@extends('pos.layouts.master')

@section('title','TambahStok')

@section('content')
<div class="col-md-12 panel-warning">
  <div class="content-box-header panel-heading">
    <div class="panel-title">Tambah Stok</div>
  </div>

  <div class="content-box-large">
        <div class="table-responsive">
          <div id="tampilDaftarStok">

          </div>
        </div>
  </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" tabindex="-1" id="modalTambah" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Stok</h4>
      </div>

      <div class="modal-body">
        <form id="fTambahStok">
          <div class="form-group">
            <label for="barcode">Barcode</label>
            <input type="text" class="form-control" id="barcode" disabled>
          </div>

          <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="text" class="form-control" id="jumlah" disabled>
          </div>

          <div class="form-group">
            <label for="tambahStok">Tambah Stok</label>
            <input type="text" class="form-control" id="tambahStok">
          </div>

          <button type="button"
                  class="btn btn-default"
                  data-dismiss="modal"
                  id="btn-tambah">
            Tambah
          </button>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button"
                class="btn btn-default"
                data-dismiss="modal"
                id="tutup">
          Tutup
        </button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  //Tampil Daftar Stok
  $.ajax({
    url : '/pos/persedian/daftarStok',
    method : 'get',
    success : function(response){
      $('#tampilDaftarStok').html(response);
    }
  })

  //tambah stok
  function getStok(id,jumlah){
    var fmTambah = $('#'+id).val();

    //console.log(fmTambah);
    $.ajax({
      url     : '/pos/persedian/tambahkanStok',
      method  : 'get',
      data    : {'id': id , 'tambah' : fmTambah, 'jumlah' : jumlah},
      success : function(response){
        //console.log(response);
        $('#tampilDaftarStok').load('/pos/persedian/daftarStok');
        // $('#barcode').val(response[0].barcode);
        // $('#jumlah').val(response[0].jumlah);
      }
    })
  }

</script>
@endsection
