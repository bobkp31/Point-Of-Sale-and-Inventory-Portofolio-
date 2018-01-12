<div class="row">
  <div class="col-md-12 panel-warning">
  	<div class="content-box-header panel-heading">
  	  <div class="panel-title ">Daftar Pemasok</div>
  	</div>

    <div class="content-box-large box-with-header">
      <!-- Tabel Produk -->
      <div class="table-responsive">
        <table id="tabelDaftarPemasok" class="table table-hover table-bordered">
          <thead>
            <tr class="warning">
              <th>Nama Pemasok</th>
              <th>Alamat</th>
              <th>Kota</th>
              <th>Email</th>
              <th>No Telphone</th>
              <th>No Handphone</th>
              {{-- <th>Hapus</th> --}}
              <th>Edit</th>
            </tr>
          </thead>
        </table>
      </div>
      <!-- End Tabel Produk -->
    </div>

  </div>
</div>

<script>
$('#tabelDaftarPemasok').DataTable({
      processing: true,
      serverSide: true,
      ajax: '/pemasok/tambahPemasok/dataTablesPemasok',
      columns: [
        {data: 'nama_pemasok', name: 'nama_pemasok'},
        {data: 'alamat', name: 'alamat'},
        {data: 'kota', name: 'kota'},
        {data: 'email', name: 'email'},
        {data: 'no_telpon', name: 'no_telpon'},
        {data: 'no_handphone', name: 'no_handphone'},
        // {data: 'hapus', name: 'hapus'},
        {data: 'pilihan', name: 'pilihan'},
      ]
});

function get_id(namaPemasok){
   $.ajax({
     url   : '/pemasok/tambahPemasok/get_id',
     method : 'get',
     data : {'namaPemasok' : namaPemasok},
     success : function(response){
        $('#editNama').val(response[0].nama_pemasok)
        $('#editAlamat').val(response[0].alamat)
        $('#editKota').val(response[0].kota)
        $('#editEmail').val(response[0].email)
        $('#editNoTelepon').val(response[0].no_telpon)
        $('#editNoHandphone').val(response[0].no_handphone)
        console.log(response);
     }
   })
}

$('#btnEditPemasok').click(function(){
  var nama = $('#editNama').val();
  var alamat = $('#editAlamat').val();
  var kota = $('#editKota').val();
  var email = $('#editEmail').val();
  var noTelepon = $('#editNoTelepon').val();
  var noHandphone = $('#editNoHandphone').val();

  $.ajax({
    url   : '/pemasok/tambahPemasok/editPemasok',
    method : 'get',
    data : {'nama' : nama,
            'alamat' : alamat,
            'kota' : kota,
            'email' : email,
            'noTelepon' : noTelepon,
            'noHandphone' : noHandphone
           },
    success : function(response){
       console.log(response);
       $('#tampilDaftarPemasok').load('/pemasok/tambahPemasok/daftarPemasok')
    }
  })
})

function hapusAkun(){
  console.log('hapus');
}



</script>
