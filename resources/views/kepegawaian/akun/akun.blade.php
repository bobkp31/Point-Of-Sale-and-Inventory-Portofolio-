@extends('pos.layouts.master')

@section('title','Akun')

@section('content')
<div class="jrk-marjin-bwh">
  <button type="button"
            class="btn btn-warning"
            data-toggle="modal"
            data-target="#modalTambahAkun">
            Tambah Akun
  </button>
</div>

<div id="TampildaftarAkun">

</div>

<!-- Modal Tambah Akun -->
<div class="modal fade" id="modalTambahAkun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
          Tambah Akun
        </h4>
      </div>

      <div class="modal-body">
        <!-- Begin Form -->
        <form class="form-horizontal" id="formTambahAkun" >

           <div class="form-group">
               <label for="nip" class="col-sm-2 control-label">Nip</label>
               <div class="col-sm-10">
                     <input type="text" class="form-control" id="nip" placeholder="PGW001">
               </div>
           </div>

           {{-- <div class="form-group">
               <label for="namaPegawai" class="col-sm-2 control-label">Nama Pegawai</label>
               <div class="col-sm-10">
                     <input type="text" name='namaPegawai' class="form-control" id="namaPegawai" placeholder="Anton Medan .Msc">
               </div>
           </div> --}}

           <div class="form-group">
               <label for="username" class="col-sm-2 control-label">Username</label>
               <div class="col-sm-10">
                     <input type="text"
                            class="form-control"
                            id="username">
               </div>
           </div>

           <div class="form-group">
               <label for="password" class="col-sm-2 control-label">Password</label>
               <div class="col-sm-10">
                     <input type="password"
                            name='password'
                            class="form-control"
                            id="password">
               </div>
           </div>

           <div class="form-group">
               <label for="jabatan" class="col-sm-2 control-label">Hak Akses</label>
               <div class="col-sm-10">
                 <select class="form-control" id="hakAkses">
                     <option value="Owner">Owner</option>
                     <option value="Manager">Manager</option>
                     <option value="Asisten Manager">Asisten Manager</option>
                     <option value="Kasir">Kasir</option>
                 </select>
               </div>
           </div>

           <div class="form-group">
             <div class="col-sm-offset-2 col-sm-10">
               <button type="button"
                       name="button"
                       id="btn-tambahAkun"
                       data-dismiss="modal"
                       class="btn btn-warning">
                 tambah
               </button>
             </div>
           </div>

        </form>
        <!-- End Form -->
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default"
                data-dismiss="modal">Tutup</button>
      </div>

    </div>
  </div>
</div>
<!-- End Modal Tambah Akun-->

<!-- Modal Edit Akun -->
<div class="modal fade" id="modalEditAkun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
          Edit Pegawai
        </h4>
      </div>

      <div class="modal-body">
        <!-- Begin Form -->
        <form class="form-horizontal" id="formTambahAkun" >
           <input type="hidden" class="form-control" id="eid">
           <div class="form-group">
               <label for="nip" class="col-sm-2 control-label">Nip</label>
               <div class="col-sm-10">
                     <input type="text" class="form-control" id="enip" disabled="disabled">
               </div>
           </div>

           {{-- <div class="form-group">
               <label for="namaPegawai" class="col-sm-2 control-label">Nama Pegawai</label>
               <div class="col-sm-10">
                     <input type="text" name='namaPegawai' class="form-control" id="namaPegawai" placeholder="Anton Medan .Msc">
               </div>
           </div> --}}

           <div class="form-group">
               <label for="username" class="col-sm-2 control-label">Username</label>
               <div class="col-sm-10">
                     <input type="text"
                            class="form-control"
                            id="eusername">
               </div>
           </div>

           <div class="form-group">
               <label for="password" class="col-sm-2 control-label">Password</label>
               <div class="col-sm-10">
                     <input type="password"
                            name='password'
                            class="form-control"
                            id="epassword">
               </div>
           </div>

           <div class="form-group">
               <label for="jabatan" class="col-sm-2 control-label">Hak Akses</label>
               <div class="col-sm-10">
                 <select class="form-control" id="ehakAkses">
                     <option value="Owner">Owner</option>
                     <option value="Manager">Manager</option>
                     <option value="Asisten Manager">Asisten Manager</option>
                     <option value="Kasir">Kasir</option>
                 </select>
               </div>
           </div>

           <div class="form-group">
             <div class="col-sm-offset-2 col-sm-10">
               <button type="button"
                       name="button"
                       id="btn-editAkun"
                       data-dismiss="modal"
                       class="btn btn-warning">
                 Edit
               </button>
             </div>
           </div>

        </form>
        <!-- End Form -->
      </div>

      <div class="modal-footer">
        <button type="button"
                class="btn btn-default"
                data-dismiss="modal">
                Tutup
        </button>
      </div>

    </div>
  </div>
</div>
<!-- End Modal Edit Akun -->





<script type="text/javascript">
$.ajax({
  url     : '/kepegawaian/tabelAkun',
  method  : 'get',
  success : function(response){
    $('#TampildaftarAkun').html(response);
  }
})

//Tambah Akun
$('#btn-tambahAkun').click(function(){
  var nip          = $('#nip').val();
  var username     = $('#username').val();
  var password     = $('#password').val();
  var hakAkses     = $('#hakAkses').val();

  // console.log(nip + username + password);
  $.ajax({
    url : '/kepegawaian/tambahAkun',
    method : 'get',
    data : {'nip'         : nip,
            'username'    : username,
            'password'    : password,
            'hakAkses'    : hakAkses
            },
    success : function(result){
      // console.log(result);
      $('#formTambahAkun').trigger('reset');
      $('#TampildaftarAkun').load('/kepegawaian/tabelAkun');
    }
  })
})

function getIdAkun(id)
{
  $.ajax({
    url     : '/kepegawaian/getIdAkun',
    method  : 'get',
    data    : {'id' : id},
    success :function(response){
      console.log(response);
      $('#eid').val(response[0].id);
      $('#enip').val(response[0].nip);
      $('#eusername').val(response[0].username);
      $('#epassword').val(response[0].password);
      $('#ehakAkses').val(response[0].hak_akses);
      // $('#ealamat').val(response[0].alamat);
      // $('#etanggalLahir').val(response[0].tgl_lahir);
      // $('#eoptionJabatan').text(response[0].jabatan);

    }
  })
}

//Edit Akun
$('#btn-editAkun').click(function(){
  var id       = $('#eid').val();
  var nip      = $('#enip').val();
  var username = $('#eusername').val();
  var password = $('#epassword').val();
  var hakAkses = $('#ehakAkses').val();
  // console.log(id+nip+username+password+hakAkses);
  $.ajax({
    url : '/kepegawaian/editAkun',
    method : 'get',
    data : {'idPegawai'   : id,
            'nip'         : nip,
            'username'    : username,
            'password'    : password,
            'hakAkses'    : hakAkses
            },
    success : function(result){
      // console.log(result);
      $('#TampildaftarAkun').load('/kepegawaian/tabelAkun');
    }
  })
 });

 function hapusAkun(id)
 {
   console.log(id);
   var con = confirm("Hapus ?");
   if (con == true){
     $.ajax({
       url : '/kepegawaian/hapusAkun',
       method : 'get',
       data : {'id' : id},
       success : function(result){
        //  console.log(result);
         $('#TampildaftarAkun').load('/kepegawaian/tabelAkun');
       }
     })
   }
 }
</script>
@endsection
