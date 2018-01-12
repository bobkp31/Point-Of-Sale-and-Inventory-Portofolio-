<div class="col-md-6">
  {{-- From Tambah Stok Gudang --}}
  <form id="formDetailFaktur">

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

    <div class="form-group">
      <label for="">Harga Satuan</label>
      <div class="row">
        <div class="col-xs-6">
          <input type="text" class="form-control" id="hargaSatuan">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="">Masa Berlaku</label>
      <div class="row">
        <div class="col-xs-6">
          <input type="date" class="form-control" id="masaBerlaku">
        </div>
      </div>
    </div>

    <button type="button"
            class="btn btn-danger"
            id="btn-tambahDetailFaktur">
            Tambah
    </button>

  </form>
  <div class="tulisan-tengah">
    <button type="button"
            class="btn btn-danger"
            id="btn-lihatTambahFaktur">
      Berikutnya
    </button>
  </div>
</div>

<div class="col-md-6">
    <p style="text-align:center"><b>Daftar Input </b></p>
    <table class="table">
      <tr>
        <th>Barcode</th>
        <th>Nama Barang</th>
        <th>Jumlah</th>
      </tr>
      @foreach ($tbFaktur as $faktur)
        <tr>
          <td>{{ $faktur->barcode }}</td>
          <td>{{ $faktur->nama_barang }}</td>
          <td>{{ $faktur->jumlah_barang}}</td>
        </tr>
      @endforeach
    </table>
</div>


{{-- MODAL FORM TAMBAH BARANG --}}
<div class="modal fade" id="modalTambahBarang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
          Tambah Barang
        </h4>
      </div>

      <div class="modal-body">
        {{-- AWAL FORM TAMBAH BARANG --}}
        <form class="form-horizontal"
              id="formTambahBarang">
          <div class="form-group">
            <label for="barcode" class="col-sm-2 control-label">barcode</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="barcodeTambah">
            </div>
          </div>

          <div class="form-group">
            <label for="namaBarang" class="col-sm-2 control-label">Nama Barang</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="tambahNamaBarang">
            </div>
          </div>

          <div class="form-group">
            <label for="kategori" class="col-sm-2 control-label">Kategori</label>
            <div class="col-sm-10">
              <div id="optionKategori">

              </div>

              <a href="#" data-toggle="modal"
                          data-target="#modalTambahKategori">
                          Tambah Kategori
              </a>|
              <a href="#" data-toggle="modal"
                          data-target="#modalEditKategori">
                          Semua Kategori
              </a>|
              <a href="#" data-toggle="modal"
                          data-target="#modalTambahBarcode">
                          Tambah Barcode
              </a>
            </div>
          </div>

          <div class="form-group">
            <label for="hargaJual" class="col-sm-2 control-label">Pemasok</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="tambahPemasok">
            </div>
          </div>

          <div class="form-group">
            <label for="hargaJual" class="col-sm-2 control-label">Harga Jual</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="hargaJual">
            </div>
          </div>

          <div class="form-group">
            <label for="persedianMinimum" class="col-sm-2 control-label">Persedian Minimum</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="persedianMinimum">
            </div>
          </div>


          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="button"
                      class="btn btn-default"
                      id="btn-tambahBarang">
                    Tambah
              </button>
            </div>
          </div>

        </form>
        {{-- AKHIR FORM TAMBAH BARANG --}}
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
          Tutup
        </button>
        {{-- <button type="button" class="btn btn-primary"></button> --}}
      </div>
    </div>
  </div>
</div>

{{-- END MODAL TAMBH BARANG--}}


{{-- MODAL TAMBAH KATEGORI --}}
<div class="modal fade" id="modalTambahKategori" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
          Tambah Kategori
        </h4>
      </div>

      <div class="modal-body">
         <form class="form-horizontal" id="formTambahKategori">
           <div class="form-group">
             <label for="kategori" class="col-sm-2 control-label">Kategori</label>
             <div class="col-sm-10">
               <span id="pemberitahuanInputKategori"> </span>
               <input type="text" class="form-control" id="tambahKategori">

             </div>

           </div>
           <div class="form-group">
             <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-primary" id="btn-tambahKategori">
                   Tambah
                 </button>
             </div>
           </div>
         </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
          Tutup
        </button>
        {{-- <button type="button" class="btn btn-primary"></button> --}}
      </div>
    </div>
  </div>
</div>
{{--End Modal Tambah Kategori --}}


{{-- Modal Edit Kategori --}}
<div class="modal fade" id="modalEditKategori"
                        tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close"
                              data-dismiss="modal"
                              aria-label="Close">
                              <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">
          Semua Kategori
        </h4>
      </div>

      <div class="modal-body">
        {{-- Tampil Semua kategori --}}
        <div id="modalTabelKategori">

        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        {{-- <button type="button" class="btn btn-primary"></button> --}}
      </div>
    </div>
  </div>
</div>
{{--End Modal Edit Kategori --}}

<script type="text/javascript">
//Tampil Kategori
$('#optionKategori').load('/inventory/barang/optionKategori');


//Tambah kategori
$('#btn-tambahKategori').click(function(){
  var kategori = $('#tambahKategori').val();
  $.ajax({
    url   : '/inventory/barang/tambahKategori',
    method: 'get',
    data  : {'kategori' : kategori},
    success : function(response){
      if(response == 'kosong'){
          $('#pemberitahuanInputKategori').text('Tidak boleh kosong');
      }else if(response == 'ada'){
          $('#formTambahKategori').trigger('reset');
          $('#modalTambahKategori').modal('hide');
          $('#optionKategori').load('/inventory/barang/optionKategori');
          $('#modalTabelKategori').load('/inventory/barang/tabelKategori');
      }
    }
  })
})

//lihat semua kategori
$('#modalTabelKategori').load('/inventory/barang/tabelKategori');

//Tambah Barang
$('#btn-tambahBarang').click(function(){

    var barcode = $('#barcodeTambah').val();
    var namaBarang = $('#tambahNamaBarang').val();
    var kategori = $('#kategori').val();
    var hargaJual = $('#hargaJual').val();
    var pemasok = $('#tambahPemasok').val();
    var persedianMinimum = $('#persedianMinimum').val();
    // console.log(barcode + namaBarang + kategori  + hargaJual + persedianMinimum + tambahPemasok);
    $.ajax({
      url   : '/inventory/barang/tambahBarang',
      method: 'get',
      data  : {'barcode' : barcode,
               'namaBarang' : namaBarang,
               'kategori' : kategori,
               'hargaJual' : hargaJual,
               'pemasok' : pemasok,
               'persedianMinimum' : persedianMinimum
              },
      success : function(response){
        $('#formTambahBarang').trigger('reset');
      }
    })
})


//Selanjutnya
$('#btn-lihatTambahFaktur').click(function(){
    var noFaktur = $('#noFaktur').val();
    var idPemasok = $('#idPemasok').val();

    if(noFaktur.length <= 0){
       alert('Nomor Faktur Tidak Boleh Kosong !!');
    }else if(noFaktur.length > 0){
      $.ajax({
         url    : '/inventory/faktur/daftarTambahFaktur',
         method : 'get',
         data   : {
                    'noFaktur' :noFaktur,
                    'idPemasok':idPemasok
                  },
         success: function(response){
          //  console.log(response);
            if(response == 'tidak ada faktur'){
              alert('Faktur Tidak Terdaftar, Silahkan Tambah Faktur Terlebih Dahulu');
            }else{
              // console.log(response);
              $('#kotakTambahFaktur').html(response);
            }
         }
      })
    }

    // console.log(idPemasok);
})

//Tekan enter di dalam form barcode
$('#barcode').keypress(function(event){
  var barcode = $(this).val();
  var pemasok = $('#idPemasok').val();
  if(event.which == 13){
    event.preventDefault();

    //Cari barcode Fakur
    $.ajax({
       url    : '/inventory/faktur/cariBarcodeFaktur',
       method : 'get',
       data   : {'barcode':barcode},
       success: function(response){
            if(response == 'kosong'){
               alert('Barang Belum Terdaftar Di Gudang !!');
               //Modal Tambah Barang
               $('#modalTambahBarang').modal('show');
               $('#barcodeTambah').val(barcode);
               $('#tambahPemasok').val(pemasok);
            }else{
              // console.log(response);
              $('#namaBarang').val(response[0].nama_barang);
            }
       }
    })

  }
})

//Tambah Detail Faktur
$('#btn-tambahDetailFaktur').click(function(e){
  e.preventDefault();

  var barcode     = $('#barcode').val();
  var jumlah      = $('#jumlah').val();
  var hargaSatuan = $('#hargaSatuan').val();
  var masaBarlaku = $('#masaBerlaku').val();
  var noFaktur    = $('#noFaktur').val();
  var idPemasok   = $('#idPemasok').val();
  // console.log(masaBarlaku);

  $.ajax({
     url    : '/inventory/faktur/tambahDetailFaktur',
     method : 'get',
     data   : {
                'barcode':barcode,
                'jumlah':jumlah,
                'hargaSatuan':hargaSatuan,
                'masaBarlaku':masaBarlaku,
                'noFaktur':noFaktur,
                'idPemasok':idPemasok
               },
     success: function(response){

          if(response == 'noFaktur Kosong'){
             alert('No Faktur Tidak Boleh Kosong !!')
          }else if(response == 'barang sudah ada'){
             alert('Barang Sudah Ada !!')
          }else{
            console.log(response);
            //load kotak tambah faktru
            $.ajax({
               url    : '/inventory/faktur/formTambahFaktur',
               method : 'get',
               data   : {
                         'noFaktur':noFaktur,
                         'idPemasok' : idPemasok
                         },
               success: function(response){
                    $('#kotakTambahFaktur').html(response);
               }
            })

          }
     }
  })
})
</script>
