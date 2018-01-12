<div class="col-md-8 panel-info">
  <div class="content-box-header panel-heading">
    <div class="panel-title ">Tampil Diskon Item</div>

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
      ajax: '/pos/diskon/dataTablesDiskonItem/',
      columns: [
          {data: 'barcode', name: 'barcode'},
          {data: 'nama_barang', name: 'nama_barang'},
          {data: 'persentase', name: 'persentase'},
          {data: 'tgl_berlaku', name: 'tgl_berlaku'},
          {data: 'tgl_berakhir', name: 'tgl_berakhir'},
          {data: 'pilihan', name: 'pilihan', orderable: false, searchable: false}
      ]
  });

function get_diskonItem(id){
  $.ajax({
    url : '/pos/diskon/getDiskonItem',
    method   : 'get',
    data     : {'id' : id},
    success  : function(response){
      //console.log(response);

      var tglBerlaku = response[0].tgl_berlaku;
      var tanggalBerlaku = tglBerlaku.split(" ");

      var tglBerakhir = response[0].tgl_berakhir;
      var tanggalBerakhir = tglBerakhir.split(" ");

      //console.log(tanggalBerlaku[1]);

      $('#id').val(id);
      $('#editBarcode').val(response[0].barcode);
      $('#editNamaBarang').val(response[0].nama_barang);
      $('#editHargaJual').val(response[0].harga_jual);
      $('#editNilaiDiskon').val(response[0].persentase);
      $('#editHargaSetelahDiskon').val($('#editHargaJual').val() - ($('#editHargaJual').val() * (response[0].persentase/100)));
      $('#editTanggalMulai').val(tanggalBerlaku[0]);
      $('#editJamMulai').val(tanggalBerlaku[1]);
      $('#editTanggalBerakhir').val(tanggalBerakhir[0]);
      $('#editJamBerakhir').val(tanggalBerakhir[1]);
    }
  })
  //alert(id);
}

//Tentukan Diskon
$('#editNilaiDiskon').keyup(function(){
  var jenisNilai = $('#editJenisNilai').val();
  var nilaiDiskon = $('#editNilaiDiskon').val();
  var hargaJual  = $('#editHargaJual').val();

  if(jenisNilai == 'persentase')
  {
    var  nilaiDiskonPersentase = nilaiDiskon / 100;
    var  hasilDiskon = nilaiDiskonPersentase * hargaJual;
    $('#editHargaSetelahDiskon').val(hargaJual - hasilDiskon);
    //console.log(nilaiDiskonPersentase);
  }else if(jenisNilai == 'rupiah')
  {
    $('#editHargaSetelahDiskon').val(hargaJual - nilaiDiskon);
  }
})



</script>
