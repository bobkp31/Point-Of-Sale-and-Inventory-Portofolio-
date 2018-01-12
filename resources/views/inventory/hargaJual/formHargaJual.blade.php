
    <form class="form-inline" id="ubahHargaJual">
      <div class="row">
        <div class="col-xs-2">
          <label for="">barcode</label>
          <input type="text" class="form-control" id="barcode" value="{{ $barang->barcode }}" disabled="disabled">
        </div>
        <div class="col-xs-2">
          <label for="">Nama Barang</label>
          <input type="text" class="form-control" id="namaBarang" value="{{ $barang->nama_barang }}">
        </div>
        <div class="col-xs-2">
          <label for="">HPP</label>
          <input type="text" class="form-control" id="hpp" value="{{ $barang->hpp }}">
        </div>
        <div class="col-xs-2">
          <label for="">Harga Jual</label>
          <input type="text" class="form-control" id="hargaJual" value="{{ $barang->harga_jual}}">
        </div>
        <div class="col-xs-1">
          <label for="">Pilihan</label>
          <select class="form-control" id="pilihan">
            <option>%</option>
            <option>Rp</option>
          </select>
        </div>
        <div class="col-xs-2">
          <label for="">Pilihan</label>
          <input type="text" class="form-control" id="nilaiUbah">
        </div>

        <label for="">Ubah</label>
        <button type="submit" class="btn btn-default" id="btnUbahHargaJual">Ubah</button>
      </div>
    </form>

<script type="text/javascript">


   $('#nilaiUbah').keyup(function(){
     var hargaJual = $('#hargaJual').val();
     var hpp       = $('#hpp').val();
     var pilihan   = $('#pilihan').val();
     var nilaiUbah = $('#nilaiUbah').val();
    //  console.log(hpp);
     if(pilihan === '%'){
       hargaJual = parseInt(hpp) + (hpp * (nilaiUbah/100));
       $('#hargaJual').val(hargaJual);
     }else if(pilihan == 'Rp'){
       $('#hargaJual').val(nilaiUbah);
     }
   })

   $('#btnUbahHargaJual').click(function(e){
     e.preventDefault();
     var hargaJual = $('#hargaJual').val();
     var barcode = $('#barcode').val();
     $.ajax({
       url   : '/inventory/hargaJual/ubahHargaJual',
       method: 'get',
       data  : {'hargaJual' : hargaJual,
                'barcode' : barcode},
       success : function(response){
         $.ajax({
           url   : '/inventory/hargaJual/cariBarang',
           method: 'get',
           data  : {'barcode' : barcode},
           success : function(response){
             if(response == 'kosong'){
               alert('barcode tidak boleh kosong !')
             }else{
               $('#formUbahHargaJual').html(response);
             }
           }
         })

       }
     })
   })
</script>
