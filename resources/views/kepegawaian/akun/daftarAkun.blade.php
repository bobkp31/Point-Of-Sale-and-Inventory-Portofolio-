<div class="row">
  <div class="col-md-12 panel-warning">
     <div class="content-box-header panel-heading">
        <div class="panel-title ">Daftar Pegawai</div>
     </div>

     <div class="content-box-large box-with-header">
       <!-- Tabel Produk -->
       <div class="table-responsive ">
         <table id="dtAkun" class="table table-hover table-bordered">
           <thead>
             <tr>
               <th>Nip</th>
               <th>Nama Pegawai</th>
               <th>Username</th>
               <th>Password</th>
               <th>Hak Akses</th>
               <th>Hapus</th>
               <th>Edit</th>
             </tr>
           </thead>
         </table>
       </div>
       <!-- Akhir Tabel Produk -->
     </div>

  </div>
</div>

<script type="text/javascript">
$('#dtAkun').DataTable({
      processing: true,
      serverSide: true,
      ajax: '/kepegawaian/dataTablesAkun',
      columns: [
          {data: 'nip', name: 'nip'},
          {data: 'nama', name: 'nama'},
          {data: 'username', name: 'username'},
          {data: 'password', name: 'password'},
          {data: 'hak_akses', name: 'hak_akses'},
          {data: 'hapus', name: 'hapus', orderable: false, searchable: false},
          {data: 'pilihan', name: 'pilihan', orderable: false, searchable: false}
      ]
  });
</script>
