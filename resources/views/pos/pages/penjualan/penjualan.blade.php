@extends('pos.layouts.masterPenjualan')

@section('content')

<div class="col-md-8" >
  <div class="content-box-large">
		  <div class="panel-heading">

          <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-4">
                <div class="input-group">
                    <div class="input-group-btn">
                      <button type="button"
                              class="btn btn-primary dropdown-toggle"
                              data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false">
                            {{ session('username') }} <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        <li><a href="/logout">Log Out</a></li>
                      </ul>
                    </div><!-- /btn-group -->
                    <input type="text" class="form-control"  value="{{session('nip')}}" disabled="disabled" style="border-color:#428BCA">
                  </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->

				   <div class="text-right">
              <button class="btn btn-primary btn-primary btn-transaksi-jarak"
                      id="btn-transaksi">
                Transaksi
              </button>
              <button class="btn btn-primary btn-transaksi-jarak"
                      id="btn-transaksiYangDiSimpan">
                Transaksi Disimpan
              </button>
              <button class="btn btn-primary btn-transaksi-jarak"
                      id="btn-rekapKas">
                Rekap Kas
              </button>
              <button class="btn btn-primary"
                      id="btn-hapusTransaksi">
                Pilihan
              </button>
					 </div>

       </div>

		   <div class="panel-body">
         <div class="row">
             <div class="col-md-3 col-sm-3">
               {{-- Form BARCODE --}}
                 <input type="text"  class="form-control scan-barcode-bawah" id="cariBarang" >
                 <input type="hidden"  id="qty" value='1'>
             </div>
         </div>
         <div id="tabelTransaksi">

         </div>

		  	</div>
	</div>

  <!--modal bayar -->
  <div class="modal fade bs-example-modal-sm" id="modalBayar" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-body">

          <div class="row">
            <div class="col-md-offset-3 col-md-6">
              <form id="formModalBayar">
              <center>
                <label>Pembayaran</label>
                <select class="form-control" name="" id='jenisPembayaran'>
                  <option value="tunai">Tunai</option>
                  <option value="debit">Debit</option>
                </select>

                <label for=""></label>
                <input type="text" class="form-control" id="pembayaran">

                <label>Kembalian</label>
                <input type="text" class="form-control" disabled="disabled" id="kembalian">
                {{-- <button  class="btn btn-primary btn-bayar-atas">
                  Cetak Struk
                </button> --}}
              </center>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>




</div>

<div class="col-md-4">
  <div class="content-box-large body-panjang">
    <div id="kotakDetailTransaksi">
    </div>
    <div id="kotakPemberitahuanDiskon" style="color:red">
    </div>

    <center>
      {{-- <button class="btn btn-primary">Simpan</button>
      <button class="btn btn-primary">Bayar</button> --}}
    </center>
  </div>
</div>

<script type="text/javascript">
  //Detail Kotak Penjualan
  $.ajax({
    url  : '/pos/penjualan/kotakDetailTransaksi',
    method : 'get',
    success : function(response){
      console.log(response);
      $('#kotakDetailTransaksi').html(response);
    }
  })

  //Kotak Pemberitahuan Diskon
  $.ajax({
    url  : '/pos/penjualan/kotakPemberitahuanDiskon',
    method : 'get',
    success : function(response){
      // console.log(response);
      $('#kotakPemberitahuanDiskon').html(response);
    }
  })

  //cari Barang
  $('#cariBarang').keyup(function(e){
    // 13 kode untuk enter
    var tekan = e.which;
    var qty = $('#qty').val();
    var barcode = $(this).val();

    if(tekan == 73){
      var ini = $(this).val();
      $('#qty').val(ini);
      // var qt = $('#qty').val();
      // console.log(qty);
      this.value = this.defaultValue;
    }

    if(tekan == 13){
      this.value = this.defaultValue;
      $.ajax({
        url  : '/pos/penjualan/cariBarang',
        method : 'get',
        data   : {'barcode' : barcode,'qty' : qty},
        success : function(response){
          //  console.log(response);
          $('#tabelTransaksi').load('/pos/penjualan/tabelTransaksi');
          $('#qty').val('1');
          $('#kotakDetailTransaksi').load('/pos/penjualan/kotakDetailTransaksi');
            //meberitahukan diskon minimum item
            var r = response[0].length;
            var s = response[1].length;

            if (r > 0){
              var namaBarang = response[0][0].nama_barang;
              var persentase = response[0][0].persentase;
              var qtyMinimum = response[0][0].qty_pembelian;
              $('#diskonMinimumItem').text(namaBarang+' Berlaku Potongan '+persentase+'% dengan minimum pembelian '+qtyMinimum);
            }else if(s > 0){
              //meberitahukan diskon item
              var namaBarang2 = response[1][0].nama_barang;
              var persentase2 = response[1][0].persentase;
              $('#diskonItem').text(namaBarang2+' Berlaku Potongan '+persentase2+'% ');
            }
            //
        }
      })
    }
  })



  $.ajax({
    url  : '/pos/penjualan/tabelTransaksi',
    method : 'get',
    success : function(response){
      $('#tabelTransaksi').html(response);
    }
  })

  $('#btn-transaksi').click(function(){
    // alert('helo');
    $.ajax({
      url  : '/pos/penjualan/tabelTransaksi',
      method : 'get',
      success : function(response){
        $('#tabelTransaksi').html(response);
        $('#kotakDetailTransaksi').load('/pos/penjualan/kotakDetailTransaksi');
      }
    })
  })

  $('#btn-transaksiYangDiSimpan').click(function(e){
    e.preventDefault();
    // alert('helo');
    $.ajax({
      url  : '/pos/penjualan/tabelSimpanTransaksi',
      method : 'get',
      success : function(response){
        // console.log(response);
        $('#tabelTransaksi').html(response);
      }
    })
  })

  // Hapus Transaksi
  $('#btn-hapusTransaksi').click(function(){
    $.ajax({
      url    : '/pos/penjualan/getTransaksiDiProses',
      method : 'get',
      success : function(response){
        $('#tabelTransaksi').html(response);
      }
    })

  })


  //Interaksi Keyboard
  $(window).keypress(function(e){
    var tekan = e.which;
    //jika menekan p (bayar dan Print)
    if(tekan == 112) {
      // console.log('tekan p');
      $('#modalBayar').modal('show');
    // Jika Menekan D (hapus transaksi)
    }else if (tekan == 100) {
      $('#modalHapusItem').modal('show');


    // jika bemenekan S (simpan Transaksi)
  }else if(tekan ==  115){
    var noPenjualan = $('#noPenjualan').val();

    // ubah status Transaksi jadi Simpan
    $.ajax({
      url    : '/pos/penjualan/simpanTransaksi',
      method : 'get',
      data   : {'noPenjualan'   : noPenjualan },
      success : function(response){
        console.log(response);
        $('#tabelTransaksi').load('/pos/penjualan/tabelTransaksi');
      }
    })
  }

  })



  $('#pembayaran').keyup(function(e){
    var totalBayarsebelum = $('#totalBayar').text();
    var totalBayar = parseFloat(totalBayarsebelum.replace('.',''));

    var totalTransaksi = $('#totalTransaksi').text();
    var totalPotonganItem = $('#textTotalDiskonItem').text();

    var totalPotonganTransaksiSebelum = $('#textDiskonTransaksi').text();
    var totalPotonganTransaksi = parseFloat(totalPotonganTransaksiSebelum.replace('.',''));

    var totalTransaksiSetelahPotongan = totalBayar;

    var pembayaran = $(this).val();
    var kembalian  = $('#kembalian').val(pembayaran - totalBayar);
    var nilaiKembalian = $('#kembalian').val();
    var jenisPembayaran = $('#jenisPembayaran').val();

    $('#textKembalian').text(nilaiKembalian);
    $('#textPembayaran').text(pembayaran);

    //jika menekan enter (bayar transaksi)
    if (e.which == 13){
      var noPenjualan = $('#noPenjualan').val();
      $.ajax({

        url    : '/pos/penjualan/bayarTransaksi',
        method : 'get',
        data   : {'totalTransaksi'   : totalTransaksiSetelahPotongan,
                  'nominalPembayaran': pembayaran,
                  'kembalian'        : nilaiKembalian,
                  'jenisPembayaran'  : jenisPembayaran,
                  'totalPotonganTransaksi' : totalPotonganTransaksi,
                  'noPenjualan'      : noPenjualan
                 },
        success : function(response){
          console.log(response);
          $('#modalBayar').modal("hide");
          $('#tabelTransaksi').load('/pos/penjualan/tabelTransaksi');
          $('#formModalBayar').trigger('reset');
        }
      })

      var print = printpage();

      function printpage(){
        var page = window.open('/pos/penjualan/printBill/'+ noPenjualan+ '','popupwindow','scrollbars=yes, width=750,height=600');
        page.print();
      }

    }

  })

  $('#btn-rekapKas').click(function(){
    $.ajax({
      url    : '/pos/penjualan/rekapKas',
      method : 'get',
      success : function(response){
        console.log(response);
        $('#tabelTransaksi').load('/pos/penjualan/rekapKas');
      }
    })
  })

</script>

@endsection
