<div class="form-group">
 <label for="diskon" class="control-label">Barcode</label>
 <div class="row">
   <div class="col-sm-6 jrk-marjin-bwh">
     <input type="text" id="barcode" class="form-control">
   </div>
   <div class="col-sm-2">
     <button type="button" id="cariBarcodeItem" class="btn btn-primary">
       cari
     </button>
   </div>
 </div>
</div>

<div class="form-group">
  <label for="namaBarang" class="control-label">Nama Barang</label>
  <div class="row">
    <div class="col-sm-12">
      <input type="text" id="namaBarang" class="form-control" disabled>
    </div>
  </div>
</div>

<div class="form-group">
  <label for="hargaJual" class="control-label">Harga Jual</label>
  <div class="row">
    <div class="col-sm-12">
      <input type="text" id="hargaJual" class="form-control" disabled>
    </div>
  </div>
</div>

 <div class="form-group">
  <label for="diskon" class="control-label">Mendapatkan Diskon</label>
  <div class="row">

    <div class="col-sm-4 jrk-marjin-bwh">
      <select id="jenisNilai" class="form-control">
        <option value="persentase">%</option>
        <option value="rupiah">Rp.</option>
      </select>
    </div>
    <div class="col-sm-6">
      <input type="text" id="nilaiDiskon" class="form-control">
    </div>
  </div>
</div>

<div class="form-group">
  <label for="hargaSetelahDiskon" class="control-label">Harga Setelah Diskon</label>
  <div class="row">
    <div class="col-sm-8">
      <input type="text" id="hargaSetelahDiskon" class="form-control">
    </div>
  </div>
</div>

<div class="form-group">
  <label for="tanggalMulai" class="control-label">Tanggal Mulai</label>
  <div class="row">
    <div class="col-sm-6 jrk-marjin-bwh ">
        <input type="date" id="tanggalMulai" class="form-control">
    </div>
    <div class="col-sm-6">
      <input type="time" id="jamMulai" class="form-control">
    </div>
  </div>

</div>


<div class="form-group">
  <label for="tanggalBerakhir" class="control-label">Tanggal Berakhir</label>
  <div class="row">
    <div class="col-sm-6 jrk-marjin-bwh ">
      <input type="date" id="tanggalBerakhir" class="form-control">
    </div>
    <div class="col-sm-6">
      <input type="time" id="jamBerakhir" class="form-control">
    </div>
  </div>
</div>

<hr>
<div class="form-group">
  <div class="row">
    <div class=" col-sm-8">
      <button type="button" class="btn btn-primary" id="btn-tambahDiskonItem">
        Tambah
      </button>
    </div>
  </div>
</div>

<script type="text/javascript">
//cari barcode Diskon item
$('#cariBarcodeItem').click(function(){
  var barcode = $('#barcode').val();
  $.ajax({
    url     : '/pos/diskon/cariBarcode',
    method  : 'get',
    data    : {'barcode' : barcode},
    success : function(response){
      console.log(response);
      $('#namaBarang').val(response[0].nama_barang);
      $('#hargaJual').val(response[0].harga_jual);
      // $('#tampilJenisDiskon').html(response);
    }
  })
})

//Tentukan Diskon
$('#nilaiDiskon').keyup(function(){
  var jenisNilai = $('#jenisNilai').val();
  var nilaiDiskon = $('#nilaiDiskon').val();
  var hargaJual  = $('#hargaJual').val();

  if(jenisNilai == 'persentase')
  {
    var  nilaiDiskonPersentase = nilaiDiskon / 100;
    var  hasilDiskon = nilaiDiskonPersentase * hargaJual;
    $('#hargaSetelahDiskon').val(hargaJual - hasilDiskon);
    //console.log(nilaiDiskonPersentase);
  }else if(jenisNilai == 'rupiah')
  {
    $('#hargaSetelahDiskon').val(hargaJual - nilaiDiskon);
    console.log('rupiah')
  }
})

//Tambah Diskon Item
$('#btn-tambahDiskonItem').click(function(){
  var barcode     = $('#barcode').val();
  var namaBarang  = $('#namaBarang').val();
  var hargaJual   = $('#hargaJual').val();
  var jenisNilai  = $('#jenisNilai').val();
  var nilaiDiskon = $('#nilaiDiskon').val();
  var hargaSetelahDiskon = $('#hargaSetelahDiskon').val();
  var tanggalMulai    = $('#tanggalMulai').val();
  var jamMulai        = $('#jamMulai').val();
  var tanggalBerakhir = $('#tanggalBerakhir').val();
  var jamBerakhir     = $('#jamBerakhir').val();

  // alert(tanggalBerakhir);

  $.ajax({
    url     : '/pos/diskon/tambahDiskonItem',
    method  : 'get',
    data    : {'barcode' : barcode, 'namaBarang' : namaBarang,
               'hargaJual' : hargaJual, 'jenisNilai' : jenisNilai,
               'nilaiDiskon' : nilaiDiskon, 'hargaSetelahDiskon' : hargaSetelahDiskon,
               'tanggalMulai' : tanggalMulai, 'jamMulai' : jamMulai,
               'tanggalBerakhir' : tanggalBerakhir, 'jamBerakhir' : jamBerakhir },
    success : function(response){
      //console.log(response);
      $('#formTambahDiskon').trigger('reset');
      $('#tabelDiskon').load('/pos/diskon/tabelDiskonItem');
    }
  })
})

</script>
