<div class="row">
  <div class="col-md-12 panel-warning">
  	<div class="content-box-header panel-heading">
  	  <div class="panel-title ">Daftar Pegawai</div>
  	</div>

    <div class="content-box-large box-with-header">
    <!-- Tabel Produk -->
    <div class="table-responsive ">
        <table id="dtPegawai" class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>NIP</th>
              <th>Nama Pegawai</th>
              <th>Jabatan</th>
              <th>Hapus</th>
              <th>Edit</th>
            </tr>
          </thead>
        </table>
    </div>
    <!-- Akhir Tabel Pegawai -->
  	</div>

  </div>
</div>

<script type="text/javascript">
//datatables Daftar Produk
  $('#dtPegawai').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/kepegawaian/dataTablesPegawai',
        columns: [
            {data: 'nip', name: 'nip'},
            {data: 'nama', name: 'nama_pegawai'},
            {data: 'jabatan', name: 'jabatan'},
            {data: 'hapus', name: 'hapus', orderable: false, searchable: false},
            {data: 'pilihan', name: 'pilihan', orderable: false, searchable: false}
        ]
    });


</script>
