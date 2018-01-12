<div class="col-md-12">
    {{-- From Faktur --}}
    <form>
      <div class="row">
        <div class="col-md-3 col-sm-3">
          <div class="form-group">
            <label for="">Tanggal Jatuh Tempo</label>
            <div class="row">
              <div class="col-xs-10">
                <input type="date" class="form-control" id="tangalJatuhTempo">
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-3">
          <div class="form-group">
            <label for="">Nomor Order</label>
            <div class="row">
              <div class="col-xs-10">
                <input type="text" class="form-control" id="nomorOrder">
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-3">
          <div class="form-group">
            <label for="">Tanggal Order</label>
            <div class="row">
              <div class="col-xs-10">
                <input type="date" class="form-control" id="tanggalOrder">
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-3">
          <div class="form-group">
            <label for="">Total</label>
            <div class="row">
              <div class="col-xs-10">
                <input type="text" class="form-control" id="total">
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="row">

        <div class="col-md-3 col-sm-3">
          <div class="form-group">
            <label for="">Total Potongan</label>
            <div class="row">
              <div class="col-xs-10">
                <input type="text" class="form-control" id="totalPotongan">
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-3">
          <div class="form-group">
            <label for="">Total Bayar</label>
            <div class="row">
              <div class="col-xs-10">
                <input type="text" class="form-control" id="totalBayar">
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-6">
          <div class="form-group">
            <label for="">Keterangan</label>
            <div class="row">
              <div class="col-xs-11">
                <input type="text" class="form-control" id="keterangan">
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="row">

        <div class="col-md-3 col-sm-3">
          <div class="form-group">
            <div class="row">
              <div class="col-xs-10">
                <button type="button"
                        id="btn-tambahFaktur"
                        class="btn btn-danger" >
                  Masukan Stok
                </button>
              </div>
            </div>
          </div>
        </div>

      </div>

    </form>

</div>

<div class="col-md-12">
    <p style="text-align:center"><b>Daftar Barang Di Dalam Faktur</b></p>
    <table class="table">
      <tr>
        <th>Barcode</th>
        <th>Nama Barang</th>
        <th>Jumlah</th>
        {{-- <th>Masa Berlaku</th> --}}
      </tr>
      @foreach ($detailFaktur as $faktur)
        <tr>
          <td>{{ $faktur->barcode }}</td>
          <td>{{ $faktur->nama_barang}}</td>
          <td>{{ $faktur->jumlah_barang}}</td>
        </tr>
      @endforeach
    </table>
</div>

<script type="text/javascript">
  $('#btn-tambahFaktur').click(function(){
    var tanggalJatuhTempo = $('#tangalJatuhTempo').val();
    var nomorOrder = $('#nomorOrder').val();
    var tanggalOrder = $('#tanggalOrder').val();
    var total = $('#total').val();
    var totalPotongan = $('#totalPotongan').val();
    var totalBayar = $('#totalBayar').val();
    var keterangan = $('#keterangan').val();
    var noFaktur = $('#noFaktur').val();
    var idPemasok = $('#idPemasok').val();

    // console.log(tanggalJatuhTempo + nomorOrder + tanggalOrder + total + totalPotongan + totalBayar + keterangan);
    $.ajax({
       url    : '/inventory/faktur/updateFaktur',
       method : 'get',
       data   : {'tanggalJatuhTempo': tanggalJatuhTempo,
                 'nomorOrder': nomorOrder,
                 'tanggalOrder': tanggalOrder,
                 'total': total,
                 'totalPotongan': totalPotongan,
                 'totalBayar': totalBayar,
                 'keterangan': keterangan,
                 'noFaktur': noFaktur,
                 'idPemasok': idPemasok,
                },

       success: function(response){
            if(response == 'jatuh tempo kosong'){
               alert('Tanggal Jatuh Tempo Tidak Boleh kosong');
            }else if(response == 'tanggal order kosong'){
               alert('Tanggal Order Tidak Boleh kosong')
            }else if(response == 'total kosong'){
               alert('Total Tidak Boleh kosong')
            }else if(response == 'total potongan kosong'){
               alert('Total potongan Tidak Boleh kosong')
            }else if(response == 'total bayar kosong'){
               alert('Total bayar Tidak Boleh kosong')
            }else if(response == 'nomor faktur kosong'){
               alert('Nomor Faktur Tidak Boleh kosong')
            }else{
              //cetak faktur jika inggin
              var persetujuan = confirm('Cetak Bukti Input Faktur ?')
              if( persetujuan == true){
                var page = window.open('/inventory/faktur/cetakFaktur/'+ noFaktur+ '/'+idPemasok+'','popupwindow','scrollbars=yes, width=750,height=600');
                page.print();
              }

              $('#kotakTambahFaktur').load('/inventory/faktur/formTambahFaktur');
            }

       }
    })
  })
</script>
