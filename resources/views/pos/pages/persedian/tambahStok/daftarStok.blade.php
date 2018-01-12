<table id="tabelDaftarStok" class="table table-bordered table-hover">
      <thead>
        <tr class="warning">
          <th>Barcode</th>
          <th>Nama Barang</th>
          <th>Hpp</th>
          <th>Harga Jual</th>
          <th>Stok</th>
          {{-- <th>Tambah</th>
          <th>Pilihan</th> --}}
        </tr>
      </thead>

  </table>

  <script type="text/javascript">
  //datatables Daftar Produk
    $('#tabelDaftarStok').DataTable({
          processing: true,
          serverSide: true,
          ajax: '/pos/persedian/dataTablesStok',
          columns: [
            {data: 'barcode', name: 'barcode'},
            {data: 'nama_barang', name: 'nama_barang'},
            {data: 'hpp', name: 'hpp'},
            {data: 'harga_jual', name: 'harga_jual'},
            {data: 'jumlah', name: 'jumlah'},
            // {data: 'tambah', name: 'tambah'},
            // {data: 'pilihan', name: 'pilihan', orderable: false, searchable: false}
          ]
      });
  </script>
