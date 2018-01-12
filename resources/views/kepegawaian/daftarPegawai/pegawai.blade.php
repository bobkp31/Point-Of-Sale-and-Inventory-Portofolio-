@extends('pos.layouts.master')

@section('title','Pegawai')

@section('content')

<div class="jrk-marjin-bwh">
  <button type="button"
          class="btn btn-info"
          data-toggle="modal"
          data-target="#modalTambahPegawai">
          Tambah Pegawai
  </button>
</div>

<div id="TampildaftarPegawai">

</div>

<!-- Modal Tambah Pegawai -->
<div class="modal fade" id="modalTambahPegawai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
          Tambah Pegawai
        </h4>
      </div>

      <div class="modal-body">
        <!-- Begin Form -->
        <form method="post" id="formTambahPegawai" class="form-horizontal" role="form">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
           <div class="form-group">
               <label for="NIP" class="col-sm-2 control-label">NIP</label>
               <div class="col-sm-10">
                     <input type="text" name='NIP' class="form-control" id="NIP">
               </div>
           </div>

           <div class="form-group">
               <label for="namaPegawai" class="col-sm-2 control-label">Nama Pegawai</label>
               <div class="col-sm-10">
                     <input type="text" name='namaPegawai' class="form-control" id="namaPegawai">
               </div>
           </div>

           <div class="form-group">
               <label for="jabatan" class="col-sm-2 control-label">Jabatan</label>
               <div class="col-sm-10">
                 <select class="form-control" name="jabatan" id="jabatan">
                   @foreach ($tbJabatan as $jabatan)
                     <option value="{{$jabatan->id}}">{{ $jabatan->jabatan }}</option>
                   @endforeach
                 </select>
               </div>
           </div>

           <div class="form-group">
               <label for="alamat" class="col-sm-2 control-label">Alamat</label>
               <div class="col-sm-10">
                     <input type="text"  class="form-control" id="alamat">
               </div>
           </div>

           <div class="form-group">
               <label for="tanggalLahir" class="col-sm-2 control-label">Tanggal Lahir</label>
               <div class="col-sm-10">
                     <input type="date"  class="form-control" id="tanggalLahir">
               </div>
           </div>

           <div class="form-group">
             <div class="col-sm-offset-2 col-sm-10">
               <button type="button" id="btn-tambahPegawai" class="btn btn-primary" data-dismiss="modal">
                 Tambah
               </button>
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
<!-- End Modal Tambah Pegawai -->


<!-- Modal Edit Pegawai -->
<div class="modal fade" id="modalEditPegawai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
        <form method="post" id="formEditPegawai" class="form-horizontal" role="form">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" class="form-control" id="eId">

           <div class="form-group">
               <label for="NIP" class="col-sm-2 control-label">NIP</label>
               <div class="col-sm-10">
                     <input type="text" class="form-control" id="eNIP" disabled="disabled">
               </div>
           </div>

           <div class="form-group">
               <label for="namaPegawai" class="col-sm-2 control-label">Nama Pegawai</label>
               <div class="col-sm-10">
                     <input type="text" name='namaPegawai' class="form-control" id="enamaPegawai">
               </div>
           </div>

           <div class="form-group">
               <label for="jabatan" class="col-sm-2 control-label">Jabatan</label>
               <div class="col-sm-10">
                 <select class="form-control" name="jabatan" id="ejabatan">
                   <option value="" id="eoptionJabatan"></option>
                   @foreach ($tbJabatan as $jabatan)
                     <option value="{{$jabatan->id}}">{{ $jabatan->jabatan }}</option>
                   @endforeach
                 </select>
               </div>
           </div>

           <div class="form-group">
               <label for="alamat" class="col-sm-2 control-label">Alamat</label>
               <div class="col-sm-10">
                     <input type="text"  class="form-control" id="ealamat">
               </div>
           </div>

           <div class="form-group">
               <label for="tanggalLahir" class="col-sm-2 control-label">Tanggal Lahir</label>
               <div class="col-sm-10">
                     <input type="date"  class="form-control" id="etanggalLahir">
               </div>
           </div>

           <div class="form-group">
             <div class="col-sm-offset-2 col-sm-10">
               <button type="button" id="btn-editPegawai" class="btn btn-primary" data-dismiss="modal">Edit</button>
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
<!-- End Modal Edit Pegawai -->






<script type="text/javascript">
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url     : '/kepegawaian/tabelPegawai',
    method  : 'get',
    success : function(response){
      $('#TampildaftarPegawai').html(response);
    }
  })

  //Tambah Pegawai
  $('#btn-tambahPegawai').click(function(){
    var nip          = $('#NIP').val();
    var namaPegawai  = $('#namaPegawai').val();
    var jabatan      = $('#jabatan').val();
    var alamat       = $('#alamat').val();
    var tanggalLahir = $('#tanggalLahir').val();
    // console.log(alamat);
    //
    $.ajax({
      url : '/kepegawaian/tambahPegawai',
      method : 'get',
      data : {'nip'         : nip,
              'namaPegawai' : namaPegawai,
              'jabatan'     : jabatan,
              'alamat'      : alamat,
              'tanggalLahir': tanggalLahir
              },
      success : function(result){
        // console.log(result);
        $('#formTambahPegawai').trigger('reset');
        $('#TampildaftarPegawai').load('/kepegawaian/tabelPegawai');
      }
    })
  })

  function hapusPegawai(id)
  {
    console.log(id);
    var con = confirm("Hapus ?");
    if (con == true){
      $.ajax({
        url : '/kepegawaian/hapusPegawai',
        method : 'get',
        data : {'id' : id},
        success : function(result){
          // console.log(result);
          $('#TampildaftarPegawai').load('/kepegawaian/tabelPegawai');
        }
      })
    }
  }

  function getIdPegawai(id)
  {
    // console.log(id);
    $.ajax({
      url     : '/kepegawaian/getIdPegawai',
      method  : 'get',
      data    : {'id' : id},
      success :function(response){
        // console.log(response);
        $('#eId').val(response[0].id);
        $('#eNIP').val(response[0].nip);
        $('#enamaPegawai').val(response[0].nama);
        $('#ejabatan').val(response[0].id_jabatan);
        $('#ealamat').val(response[0].alamat);
        $('#etanggalLahir').val(response[0].tgl_lahir);
        $('#eoptionJabatan').text(response[0].jabatan);

      }
    })
  }

  //Edit Pegawai
  $('#btn-editPegawai').click(function(){
    var id          = $('#eId').val();
    var nip         = $('#eNIP').val();
    var namaPegawai = $('#enamaPegawai').val();
    var jabatan     = $('#ejabatan').val();
    var alamat      = $('#ealamat').val();
    var tanggalLahir = $('#etanggalLahir').val();
    // console.log(jabatan);
    // console.log(nip,namaPegawai,jabatan,namaPegawai,jabatan,alamat,tanggalLahir);
    $.ajax({
      url : '/kepegawaian/editPegawai',
      method : 'get',
      data : {'idPegawai'   : id,
              'nip'         : nip,
              'namaPegawai' : namaPegawai,
              'jabatan'     : jabatan,
              'alamat'      : alamat,
              'tanggalLahir': tanggalLahir
              },
      success : function(result){
        // console.log(result);
        $('#formEditPegawai').trigger('reset');
        $('#TampildaftarPegawai').load('/kepegawaian/tabelPegawai');
      }
    })

  });

</script>
@endsection
