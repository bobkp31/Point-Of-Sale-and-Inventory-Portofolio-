<div class="col-md-8 panel-info">
  <div class="content-box-header panel-heading">
    <div class="panel-title ">Tampil Diskon Beli A Gratis B</div>

    <div class="panel-options">
      <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
      <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
    </div>
  </div>

  <div class="content-box-large box-with-header">
    <div class="table-responsive">
      <table id="dtDiskonAB" class="table table-hover">
        <thead>
          <th>Beli A</th>
          <th>Quantity A</th>
          <th>Gratis B</th>
          <th>Quantity B</th>
          <th>Kelipatan</th>
          <th>Tanggal Berlaku</th>
          <th>Tanggal Berakhir</th>
          <th>Edit</th>
        </thead>

      </table>
    </div>
  </div>
</div>

<script type="text/javascript">
$('#dtDiskonAB').DataTable({
      processing: true,
      serverSide: true,
      ajax: '/pos/diskon/dataTablesDiskonAB',
      columns: [
          {data: 'nama_barang', name: 'nama_barang'},
          {data: 'qty_pembelian', name: 'qty_pembelian'},
          {data: 'nama_barang_diskon', name: 'nama_barang_diskon'},
          {data: 'qty_bonus', name: 'qty_bonus'},
          {data: 'berlaku_kelipatan', name: 'berlaku_kelipatan'},
          {data: 'tgl_berlaku', name: 'tgl_berlaku'},
          {data: 'tgl_berakhir', name: 'tgl_berakhir'},
          {data: 'pilihan', name: 'pilihan', orderable: false, searchable: false}
      ]
  });

  function getIdDiskonAB(id){
    //alert(id);
    $.ajax({
      url : '/pos/diskon/getIdDiskonAB',
      method : 'get',
      data   : {'id' : id},
      success : function(response){
        // console.log(response);
        $('#editId').val(id);
        $('#editQtyPembelian').val(response[0].qty_pembelian);
        $('#editNamaBarangA').val(response[0].nama_barang);
        $('#editQtyBonus').val(response[0].qty_bonus);
        $('#editNamaBarangB').val(response[0].nama_barang_diskon);
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
