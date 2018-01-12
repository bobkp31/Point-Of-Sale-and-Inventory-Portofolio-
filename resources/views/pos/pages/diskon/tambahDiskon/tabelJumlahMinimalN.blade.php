<div class="col-md-8 panel-info">
  <div class="content-box-header panel-heading">
    <div class="panel-title ">Tampil Diskon Jumlah Minimal N</div>

    <div class="panel-options">
      <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
      <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
    </div>
  </div>

  <div class="content-box-large box-with-header">
    <div class="table-responsive">
      <table id="dtDiskonItem" class="table table-hover">
        <thead>
          <th>Barcode</th>
          <th>Nama Barang</th>
          <th>Minimum Pembelian</th>
          <th>Persentase</th>
          <th>Tanggal Berlaku</th>
          <th>Tanggal Berakhir</th>
          <th>Edit</th>
        </thead>

      </table>
    </div>
  </div>
</div>

<script type="text/javascript">
$('#dtDiskonItem').DataTable({
      processing: true,
      serverSide: true,
      ajax: '/pos/diskon/dataTablesDiskonMinimalN',
      columns: [
          {data: 'barcode', name: 'barcode'},
          {data: 'nama_barang', name: 'nama_barang'},
          {data: 'qty_pembelian', name: 'qty_pembelian'},
          {data: 'persentase', name: 'persentase'},
          {data: 'tgl_berlaku', name: 'tgl_berlaku'},
          {data: 'tgl_berakhir', name: 'tgl_berakhir'},
          {data: 'pilihan', name: 'pilihan', orderable: false, searchable: false}
      ]
  });

  function getIdDiskonMinimumN(id){
    console.log(id);
    $.ajax({
      url : '/pos/diskon/getIdDiskonMinimumN',
      method : 'get',
      data   : {'id' : id},
      success : function(response){
        // console.log(response);
        $('#editId').val(id);
        $('#editNamaBarang').val(response[0].nama_barang);
        $('#editHargaJual').val(response[0].harga_jual);
        $('#editQtyPembelian').val(response[0].qty_pembelian);
        $('#editNilai').val(response[0].persentase);
        if(response[0].berlaku_kelipatan == 'ya'){
          // console.log('ya');
          $('#editKelipatan').attr('checked','checked');
          $('#editKelipatan').val('ya');
        }else{
          $('#editKelipatan').val('tidak');
        }

        var waktuBerlaku  = response[0].tgl_berlaku.split(" ");
        var waktuBerakhir = response[0].tgl_berakhir.split(" ");

        $('#editTanggalBerlaku').val(waktuBerlaku[0]);
        $('#editTanggalBerakhir').val(waktuBerakhir[0]);

        $('#editJamBerlaku').val(waktuBerlaku[1]);
        $('#editJamBerakhir').val(waktuBerakhir[1]);

      }
    })
  }
</script>
