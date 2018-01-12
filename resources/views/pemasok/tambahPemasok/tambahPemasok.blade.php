@extends('pos.layouts.master')

@section('title','Tambah Pemasok')

@section('content')
<div class="jrk-marjin-bwh">
  <button type="button"
          class="btn btn-info"
          data-toggle="modal"
          data-target="#modalTambahPemasok">
        Tambah Pemasok
  </button>
</div>

<!--Tampil daftar Pemasok-->
<div id="tampilDaftarPemasok">

</div>

{{-- Modal Tambah Pemasok --}}

<!-- Modal -->
<div class="modal fade" id="modalTambahPemasok" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Pemasok</h4>
      </div>
      <div class="modal-body">
        {{-- Form tambah Pemasok --}}
        <form id="formTambahPemasok">
          <div class="form-group">
            <label for="">Nama </label>
            <input type="text" class="form-control" id="nama">
          </div>
          <div class="form-group">
            <label for="">Alamat </label>
            <input type="text" class="form-control" id="alamat">
          </div>
          <div class="form-group">
            <label for="">Kota </label>
            <input type="text" class="form-control" id="kota">
          </div>
          <div class="form-group">
            <label for="">Email </label>
            <input type="text" class="form-control" id="email">
          </div>
          <div class="form-group">
            <label for="">No Telpon</label>
            <input type="text" class="form-control" id="noTelepon">
          </div>
          <div class="form-group">
            <label for="">No Handphone </label>
            <input type="text" class="form-control" id="noHandphone">
          </div>
          <button type="button" class="btn btn-default" id="btnTambahPemasok">Tambah</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>


{{-- Modal Edit Pemasok --}}

<!-- Modal -->
<div class="modal fade" id="modalEditPemasok" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Pemasok</h4>
      </div>
      <div class="modal-body">
        {{-- Form Edit Pemasok --}}
        <form id="formEditPemasok">
          <div class="form-group">
            <label for="">Nama </label>
            <input type="text" class="form-control" id="editNama">
          </div>
          <div class="form-group">
            <label for="">Alamat </label>
            <input type="text" class="form-control" id="editAlamat">
          </div>
          <div class="form-group">
            <label for="">Kota </label>
            <input type="text" class="form-control" id="editKota">
          </div>
          <div class="form-group">
            <label for="">Email </label>
            <input type="text" class="form-control" id="editEmail">
          </div>
          <div class="form-group">
            <label for="">No Telpon</label>
            <input type="text" class="form-control" id="editNoTelepon">
          </div>
          <div class="form-group">
            <label for="">No Handphone </label>
            <input type="text" class="form-control" id="editNoHandphone">
          </div>
          <button type="button" class="btn btn-default" id="btnEditPemasok" data-dismiss="modal">Edit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>












<script type="text/javascript">
  //Tambah Pemasok
  $('#btnTambahPemasok').click(function(){
    var nama = $('#nama').val();
    var alamat = $('#alamat').val();
    var kota = $('#kota').val();
    var email = $('#email').val();
    var noTelepon = $('#noTelepon').val();
    var noHandphone = $('#noHandphone').val();

    $.ajax({
      url    : '/pemasok/tambahPemasok/tambah',
      method : 'get',
      data   : {'nama'   : nama,
                'alamat' : alamat,
                'kota'   : kota,
                'email'  : email,
                'noTelepon' : noTelepon,
                'noHandphone' : noHandphone
              },
      success : function(response){
        if(response == 'nama Kosong'){
          alert('Nama Tidak Boleh Kosong !')
        }else if(response == 'alamat Kosong'){
          alert('Alamat Tidak Boleh Kosong !')
        }else if(response == 'noHandphone Kosong'){
          alert('No Handphone Tidak boleh kosong !')
        }else{
          $('#formTambahPemasok').trigger('reset');
          $('#modalTambahPemasok').modal('hide');
        }

        // console.log(response);
      }
    })

  })

 //daftar Pemasok (datatables)
 $('#tampilDaftarPemasok').load('/pemasok/tambahPemasok/daftarPemasok');
</script>
@endsection
