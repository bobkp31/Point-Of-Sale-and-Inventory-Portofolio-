<div class="row">
  <div class="col-md-12 panel-warning">
    <div class="content-box-header panel-heading">
        <div class="panel-title">Daftar Barang Gudang</div>
    </div>

    <div class="content-box-large">

      {{-- Tabel Detail barang --}}
      <table class="table table-hover" id="dtBarangGudang">
        <thead>
          <tr>
              <th>Id Barang</th>
              <th>Barcode</th>
              <th>Nama</th>
              <th>kategori</th>
              <th>Hpp</th>
              <th>Harga Jual</th>
              <th>Stok Tersedia</th>
              <th>Stok Minimum </th>
              {{-- <th>Hapus</th> --}}
              <th>Edit</th>
          </tr>
        </thead>
      </table>
      <center>
        <button class="btn btn-default" id='btnCetakSemua'>
          Cetak Semua
        </button>
      </center>
    </div>
  </div>


</div>

<script type="text/javascript">
    $('#dtBarangGudang').DataTable({
          processing: true,
          serverSide: true,
          ajax: '/inventory/barang/dataTablesBarang',
          columns: [
              {data: 'id', name: 'id'},
              {data: 'barcode', name: 'barcode'},
              {data: 'nama_barang', name: 'nama_barang'},
              {data: 'kategori', name: 'kategori'},
              {data: 'hpp', name: 'hpp'},
              {data: 'harga_jual', name: 'harga_jual'},
              {data: 'stok_tersedia', name: 'stok_tersedia'},
              {data: 'stok_minimum', name: 'stok_minimum'},
              // {data: 'hapus', name: 'hapus', orderable: false, searchable: false},
              {data: 'pilihan', name: 'pilihan', orderable: false, searchable: false}
          ]
      });


      function get_id(id){
        // console.log(id);
        $.ajax({
          url : '/inventory/barang/getBarang',
          method : 'get',
          data   : {'id' : id},
          success : function(response){
            console.log(response);
            $('#editIdBarang').val(id);
            $('#editBarcode').val(response[0].barcode);
            $('#editNamaBarang').val(response[0].nama_barang);
            $('#editKategori').val(response[0].kategori);
            $('#editHpp').val(response[0].hpp);
            $('#editHargaJual').val(response[0].harga_jual);
            $('#editPersedianMinimum').val(response[0].stok_minimum);
          }
        })
      }

    $('#btnCetakSemua').click(function(){
        var page = window.open('/inventory/barang/cetakSemuaBarang/','popupwindow','scrollbars=yes, width=750,height=600');
        page.print();
    })
</script>
