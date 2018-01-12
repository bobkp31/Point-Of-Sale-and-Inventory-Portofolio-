@extends('pos.layouts.master')

@section('title','Arsip')

@section('content')
  <div class="row">
    <div class="col-md-12 panel-warning">
      {{-- <div class="content-box-header panel-heading">
          <div class="panel-title">Barang Inventory</div>
      </div> --}}

      <div class="content-box-large">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            {{-- Button Grup untuk pilih arsip --}}
            <div class="btn-group btn-group-justified jrk-marjin-bwh" role="group" aria-label="...">

              <div class="btn-group" role="group">
                <button type="button" class="btn btn-default" id="btnhari">Hari</button>
              </div>

              <div class="btn-group" role="group">
                <button type="button" class="btn btn-default" id="btnbulan">Bulan</button>
              </div>
            </div>

              <center>
                <div class="row">
                  <div id="formHari">
                    <div class="col-md-8 col-md-offset-2">
                      <input type="date" name="name" value="{{ $date = date('Y-m-d') }}" class="form-control" id="hari">
                    </div>
                  </div>

                  <div id="formBulan">
                    <div class="col-md-8 col-md-offset-2">
                      <input type="month" name="name" value="{{ $date = date('Y-m') }}" class="form-control" id="bulan">
                    </div>
                  </div>
                </div>
              </center>

          </div>
        </div>

        <hr>
        <div id="tabelDaftarFaktur">

        </div>


      </div>

    </div>
  </div>



  <script type="text/javascript">
    $('#btnhari').click(function(){
        $('#formHari').show();
        $('#formBulan').hide();
        $.ajax({
               url   : '/inventory/arsip/tabelDaftarFaktur',
               method: 'get',
               success : function(response){
                //  console.log(response);
                 $('#tabelDaftarFaktur').html(response);
               }
        })
    })

    $('#btnbulan').click(function(){
        $('#formBulan').show();
        $('#formHari').hide();
        $.ajax({
               url   : '/inventory/arsip/tabelDaftarFakturBulanan',
               method: 'get',
               success : function(response){
                //  console.log(response);
                 $('#tabelDaftarFaktur').html(response);
               }
        })
    })

    $('#formBulan').hide();

    // Tampil Faktur harian
    $('#hari').change(function(){
      // var hari = $(this).val();
      $.ajax({
             url   : '/inventory/arsip/tabelDaftarFaktur',
             method: 'get',
             success : function(response){
              //  console.log(response);
               $('#tabelDaftarFaktur').html(response);
             }
      })
    })

    $.ajax({
           url   : '/inventory/arsip/tabelDaftarFaktur',
           method: 'get',
           success : function(response){
            //  console.log(response);
             $('#tabelDaftarFaktur').html(response);
           }
    })

    // Tampil Faktur Bulanan
    $('#bulan').change(function(){
      $.ajax({
             url   : '/inventory/arsip/tabelDaftarFakturBulanan',
             method: 'get',
             success : function(response){
              //  console.log(response);
               $('#tabelDaftarFaktur').html(response);
             }
      })
    })



   //Edit Barang
  //  $('#btn-editBarang').click(function(){
  //     // console.log('hello');
  //      var idBarang   = $('#editIdBarang').val();
  //      var barcode    = $('#editBarcode').val();
  //      var namaBarang = $('#editNamaBarang').val();
  //      var kategori   = $('#editKategori').val();
  //      var hpp        = $('#editHpp').val();
  //      var hargaJual  = $('#editHargaJual').val();
  //      var persedianMinimum = $('#editPersedianMinimum').val();
   //
  //      $.ajax({
  //        url   : '/inventory/barang/editBarang',
  //        method: 'get',
  //        data  : {'id':idBarang,
  //                 'barcode' : barcode,
  //                 'namaBarang' : namaBarang,
  //                 'kategori' : kategori,
  //                 'hpp' : hpp,
  //                 'hargaJual' : hargaJual,
  //                 'persedianMinimum' : persedianMinimum
  //                },
  //        success : function(response){
  //         //  console.log(response);
  //         $('#kotakDetailBarang').load('/inventory/barang/kotakDetailBarang');
  //        }
  //      })
  //  })

  </script>
@endsection
