<div class="col-md-6">
  {{-- From Tambah Stok Gudang --}}
  <form>
    <div class="form-group">
      <label for="">Barcode</label>

      <div class="row">
        <div class="col-xs-6">
          <input type="text" class="form-control" id="barcode">
        </div>
      </div>

    </div>

    <div class="form-group">
      <label for="">Nama Barang</label>
      <div class="row">
        <div class="col-xs-10">
          <input type="text" class="form-control" id="namaBarang" disabled="disabled">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="">Jumlah</label>
      <div class="row">
        <div class="col-xs-6">
          <input type="text" class="form-control" id="jumlah">
        </div>
      </div>
    </div>

    <button type="button"
            class="btn
            btn-default"
            id="tambahPengiriman">
            Tambah
    </button>

  </form>
  <div class="tulisan-tengah">
    <button type="button"
            class="btn btn-default"
            id="btn-lihatKartuStok">
      Selanjutnya
    </button>
  </div>
</div>


<div class="col-md-6">
   <table class="table table-hover table-bordered">
     <tr>
       <th>Barcode</th>
       <th>Nama Barang</th>
       <th>Jumlah</th>
       <th>Edit</th>
     </tr>
     @foreach ($detailBarang as $barang)
       <tr>
         <td>{{ $barang->barcode }}</td>
         <td>{{ $barang->nama_barang }}</td>
         <td>{{ $barang->jumlah}}</td>
         <td>
           <button type="button"
                   class="btn btn-xs btn-danger"
                   onclick="getBarcode({{ $barang->id }})">
             edit
           </button>
         </td>
       </tr>
     @endforeach
   </table>
</div>



<script type="text/javascript">
  $('#barcode').keypress(function(event){
      var barcode = $('#barcode').val();

      //cari barang
      if( event.which == 13 ){
        event.preventDefault();
        $.ajax({
           url       : '/inventory/kirim/cariBarang',
           method    : 'get',
           data      : {'barcode' : barcode},
           success   : function(response){
            //  console.log(response);
             $('#namaBarang').val(response[0].nama_barang);
           }
        })
      }
  })

  //Tambahkan Barang untuk di kirim
  $('#tambahPengiriman').click(function(){
    // $('#kotakKirim').load('/inventory/kirim/formKirim');
    var barcode = $('#barcode').val();
    var jumlah = $('#jumlah').val();
    var toko = $('#toko').val();

    $.ajax({
       url       : '/inventory/kirim/tambahBarangKirim',
       method    : 'get',
       data      : {'barcode' : barcode,'jumlah': jumlah,'toko': toko},
       success   : function(response){
         //  console.log(response);
         if(response == 'sudah ada'){
           alert('Barang Sudah Ada !!');
           $('#kotakKirim').load('/inventory/kirim/formKirim');
         }
         $('#kotakKirim').load('/inventory/kirim/formKirim');
       }
    })

    // console.log(barcode+' '+jumlah);
  })

  function getBarcode(id){
    $('#editKrimBarang').modal('show');
    // console.log(id);
    $.ajax({
       url       : '/inventory/kirim/getBarcode',
       method    : 'get',
       data      : {'id' : id},
       success   : function(response){
          console.log(response);
          $('#editJumlah').val(response[0].jumlah);
          $('#editId').val(response[0].id);
        //  $('#kotakKirim').load('/inventory/kirim/formKirim');
       }
    })
  }

  $('#btn-editDetailKirimBarang').click(function(){
     var jumlah = $('#editJumlah').val();
     var id = $('#editId').val();
     $.ajax({
        url       : '/inventory/kirim/editDetailPegiriman',
        method    : 'get',
        data      : {'jumlah' : jumlah,'id' : id},
        success   : function(response){
          //  console.log(response);
           $('#kotakKirim').load('/inventory/kirim/formKirim');
           $('#editKrimBarang').modal('hide');
        }
     })
  })

  $('#btn-lihatKartuStok').click(function(){
    $('#kotakKirim').load('/inventory/kirim/kartuStok');
    console.log('hello');
  })
</script>
