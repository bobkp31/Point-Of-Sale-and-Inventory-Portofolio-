<!-- Daftar Produk -->
<div class="row">
  <div class="col-md-12 panel-warning">
     <div class="content-box-header panel-heading">
        <div class="panel-title ">Daftar Produk</div>
     </div>

     <div class="content-box-large box-with-header">
       <!-- Tabel Produk -->
       <div class="table-responsive">
         <table id="dtProduk" class="table table-hover table-bordered">
           <thead>
             <tr class="warning">
               <th>Barcode</th>
               <th>Kode Produk</th>
               <th>Nama Barang</th>
               <th>Harga Jual</th>
               <th>Jumlah</th>
               <th>Pilihan</th>
             </tr>
           </thead>


         </table>
       </div>
       <!-- Akhir Tabel Produk -->
     </div>
  </div>
</div>
<!-- Akhir Daftar Produk -->



<script type="text/javascript">
//datatables Daftar Produk
  $('#dtProduk').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataTablesProduk',
        columns: [
            {data: 'barcode', name: 'barcode'},
            {data: 'kd_barang', name: 'kd_barang'},
            {data: 'nama_barang', name: 'nama_barang'},
            {data: 'harga_jual', name: 'harga_jual'},
            {data: 'jumlah', name: 'jumlah'},
            {data: 'pilihan', name: 'pilihan', orderable: false, searchable: false}
        ]
    });
</script>
