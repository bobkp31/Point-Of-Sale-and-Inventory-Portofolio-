<div class="table table-responsive">
  <table class="table table-bordered" id="tbDaftarFaktur">
    <thead>
      <tr>
        <th>No Faktur</th>
        <th>Jatuh Tempo</th>
        <th>Total Harga</th>
        <th>Total Potongan</th>
        <th>Total Tagihan</th>
        <th>Lihat</th>
      </tr>
    </thead>
  </table>
</div>

<script type="text/javascript">
  var hari = $('#hari').val();

  $('#tbDaftarFaktur').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/inventory/arsip/dataTablesArsip/'+hari+'',
        columns: [
            {data: 'no_faktur', name: 'id'},
            {data: 'tanggal_jatuh_tempo', name: 'barcode'},
            {data: 'total_harga', name: 'kategori'},
            {data: 'total_potongan', name: 'hpp'},
            {data: 'total_tagihan', name: 'harga_jual'},
            // {data: 'hapus', name: 'hapus', orderable: false, searchable: false},
            {data: 'pilihan', name: 'pilihan', orderable: false, searchable: false}
        ]
    });

    function lihatDetailFaktur(id){
      $.ajax({
             url   : '/inventory/arsip/lihatDetailFaktur',
             method: 'get',
             data : {'id' : id},
             success : function(response){
               $('#tabelDaftarFaktur').html(response);
            }
      })
    }
</script>
