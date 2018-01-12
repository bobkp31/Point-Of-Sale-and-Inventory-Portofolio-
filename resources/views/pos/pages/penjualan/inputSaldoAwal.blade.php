@extends('pos.layouts.masterPenjualan')

@section('content')
  <div class="col-md-offset-4 col-md-4">

    <div class="input-Saldo-atas input-Saldo-bawah">
      <div class="form-group">
        <form method="get" action="/pos/penjualan/inputSaldoAwalDatabase">
        <label class="text-center">Masukan Saldo Awal</label>
        <input type="text" name="inpSaldo" id="inpSaldo" class="form-control" >

        <div class="row">
          <div class="col-md-offset-4 col-md-4">
            <center>
                <button type="button"
                        class="btn btn-primary btn-saldo-atas"
                        data-toggle="modal" data-target="#modalValidasiSaldo"
                        id="btn-masuk">
                  Masuk
                </button>
            </center>
          </div>
        </div>
        <br>
        <br>
        <center>
        <h5 style="color:red">
          Masukan Nilai Saldo Awal Dengan benar
          Proses Ini Tidak Bisa diubah/dibatalkan !!!
        </h5>
        </center>
      </div>
    </div>

    {{-- Modal Validasi Input Saldo --}}
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="modalValidasiSaldo">
      <div class="modal-dialog modal-sm" role="document">

        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

          </div>
          <div class="modal-body">
            <h4>Apakah Nilai Saldo Awal anda Sudah Benar ? <p> Rp <span id='saldo'></span> </h4> </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

  </div>

  <script type="text/javascript">
    $('#btn-masuk').click(function(){
      var nilaiSaldo = $('#inpSaldo').val();
      $('#saldo').text(nilaiSaldo);
    })

  </script>
@endsection
