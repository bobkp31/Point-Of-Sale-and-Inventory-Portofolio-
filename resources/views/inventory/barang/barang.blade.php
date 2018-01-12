@extends('pos.layouts.master')

@section('content')
  <div class="row">
    <div class="col-md-12 panel-warning">
      <div class="content-box-header panel-heading">
          <div class="panel-title">Barang Inventory</div>
      </div>

      <div class="content-box-large">
        <form class="form-horizontal"
              id="formTambahBarang">
          <div class="form-group">
            <label for="barcode" class="col-sm-2 control-label">barcode</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="barcode">
            </div>
          </div>

          <div class="form-group">
            <label for="namaBarang" class="col-sm-2 control-label">Nama Barang</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="namaBarang">
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
              </a>
            </div>
          </div>

          <div class="form-group">
            <label for="kategori" class="col-sm-2 control-label">Pemasok</label>
            <div class="col-sm-10">
              <select class="form-control" id="pemasok">
                @foreach ($pemasok as $pem)
                <option>{{ $pem->nama_pemasok }}</option>
                @endforeach
              </select>
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
      </div>

    </div>
  </div>

  <div id="kotakDetailBarang">

  </div>

  {{-- Modal Tambah Kategori --}}
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
            Tambah Kategori
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


  {{-- Modal Edit Barang --}}
  <div class="modal fade" id="modalEditBarang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">
            Edit Barang
          </h4>
        </div>

        <div class="modal-body">
          {{-- Form Edit Barang --}}
          <form class="form-horizontal" id="formTambahBarang">
            <input type="hidden" class="form-control" id="editIdBarang">

            <div class="form-group">
              <label for="editBarcode" class="col-sm-2 control-label">barcode</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="editBarcode" disabled="disabled">
              </div>
            </div>

            <div class="form-group">
              <label for="editNamaBarang" class="col-sm-2 control-label">Nama Barang</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="editNamaBarang">
              </div>
            </div>

            <div class="form-group">
              <label for="editKategori" class="col-sm-2 control-label">Kategori</label>
              <div class="col-sm-10">
                <select class="form-control" id="editKategori">
                  @foreach ($kategori as $kat)
                  <option>{{ $kat->kategori }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="editHpp" class="col-sm-2 control-label">HPP</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="editHpp">
              </div>
            </div>

            <div class="form-group">
              <label for="editHargaJual" class="col-sm-2 control-label">Harga Jual</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="editHargaJual">
              </div>
            </div>

            <div class="form-group">
              <label for="editPersedianMinimum" class="col-sm-2 control-label">Persedian Minimum</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="editPersedianMinimum">
              </div>
            </div>


            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="button"
                        class="btn btn-default"
                        data-dismiss="modal"
                        id="btn-editBarang">
                      Edit
                </button>
              </div>
            </div>
          </form>
          {{-- End Form edit Barang --}}
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
  {{--End Modal Edit Barang --}}


  <script type="text/javascript">
    $('#kotakDetailBarang').load('/inventory/barang/kotakDetailBarang');
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
        var barcode = $('#barcode').val();
        var namaBarang = $('#namaBarang').val();
        var kategori = $('#kategori').val();
        var hargaJual = $('#hargaJual').val();
        var pemasok = $('#pemasok').val();
        var persedianMinimum = $('#persedianMinimum').val();

        $.ajax({
          url   : '/inventory/barang/tambahBarang',
          method: 'get',
          data  : {'barcode'   : barcode,
                   'namaBarang': namaBarang,
                   'kategori'  : kategori,
                   'hargaJual' : hargaJual,
                   'pemasok'   : pemasok,
                   'persedianMinimum' : persedianMinimum
                  },
          success : function(response){
            // console.log(response);
            if(response == 'barcode kosong'){
              alert('Barcode Tidak Boleh Kosong !')
            }else if(response == 'nama barang kosong'){
              alert('Nama Barang Tidak Boleh Kosong !')
            }else if(response == 'kategori kosong'){
              alert('kategori Tidak Boleh Kosong !')
            }else if(response == 'harga jual kosong'){
              alert('Harga Jual Tidak Boleh Kosong !')
            }else if(response == 'persedian minimum kosong'){
              alert('Persedian Minimum Tidak Boleh Kosong !')
            }else{
              $('#formTambahBarang').trigger('reset');
              $('#kotakDetailBarang').load('/inventory/barang/kotakDetailBarang');
            }
          }
        })
    })

   //Edit Barang
   $('#btn-editBarang').click(function(){
      // console.log('hello');
       var idBarang   = $('#editIdBarang').val();
       var barcode    = $('#editBarcode').val();
       var namaBarang = $('#editNamaBarang').val();
       var kategori   = $('#editKategori').val();
       var hpp        = $('#editHpp').val();
       var hargaJual  = $('#editHargaJual').val();
       var persedianMinimum = $('#editPersedianMinimum').val();

       $.ajax({
         url   : '/inventory/barang/editBarang',
         method: 'get',
         data  : {'id':idBarang,
                  'barcode' : barcode,
                  'namaBarang' : namaBarang,
                  'kategori' : kategori,
                  'hpp' : hpp,
                  'hargaJual' : hargaJual,
                  'persedianMinimum' : persedianMinimum
                 },
         success : function(response){
          //  console.log(response);
          $('#kotakDetailBarang').load('/inventory/barang/kotakDetailBarang');
         }
       })
   })

  </script>
@endsection
