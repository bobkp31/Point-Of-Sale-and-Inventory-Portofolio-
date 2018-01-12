<div class="col-md-12">
  {{-- From Tambah Stok Gudang --}}
  <center>
    <h3>Kartu Pengiriman</h3>
  </center>
  <b>Nomor Pengiriman : <span id="noPengiriman">
                           {{ $noPengiriman->id }}
                        </span></b> <br>
  <b>Pengirim         : </b><br>
  <div class="table-responsive ">
    <table class="table table-bordered">
       <tr>
         <th>Barcode</th>
         <th>Nama Barang</th>
         <th>Jumlah</th>
       </tr>
       @foreach ($detail as $barang)
         <tr>
           <td>{{ $barang->barcode }}</td>
           <td>{{ $barang->nama_barang }}</td>
           <td>{{ $barang->jumlah }}</td>
         </tr>
       @endforeach
    </table>
  </div>

  <div class="tulisan-tengah">
    <button type="button"
            class="btn btn-default"
            id="btn-kirimBarang">
      Kirim
    </button>
  </div>
</div>

<script type="text/javascript">
  $('#btn-kirimBarang').click(function(){
    // console.log('hello');
    var confirmPengiriman = confirm('Apakah Barang Sudah Benar ?');
    var noPengiriman = $('#noPengiriman').text();
    if (confirmPengiriman == true) {
      $.ajax({
         url       : '/inventory/kirim/kirimBarang/',
         method    : 'get',
         data      : {'noPengiriman' : noPengiriman},
         success   : function(response){
           console.log(noPengiriman);
           var cetakPengiriman = confirm('Cetak Kartu Pengiriman ?');
           if (cetakPengiriman == true){
               var page = window.open('/inventory/kirim/cetakKartuPengiriman/'+noPengiriman+'','popupwindow','scrollbars=yes, width=750,height=600');
               page.print();
           }
           $('#kotakKirim').load('/inventory/kirim/formKirim');


         }
      })
    }
  })
</script>
