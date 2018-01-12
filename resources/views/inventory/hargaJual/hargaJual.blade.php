@extends('pos.layouts.master')

@section('content')
  <div class="row">
    <div class="col-md-12 panel-warning">
      <div class="content-box-header panel-heading">
          <div class="panel-title">Harga Jual</div>
      </div>

      <div class="content-box-large">
        <form class="form-inline">
          <div class="form-group">
            <label class="sr-only" for="barcode">Barcode</label>
            <input type="email" class="form-control" id="barcode">
          </div>
        <button type="submit" class="btn btn-default" id="btnCariBarang">Cari</button>
        </form>

        <hr>
        <div id="formUbahHargaJual">
        </div>

      </div>
    </div>
  </div>



  <script type="text/javascript">
     $('#btnCariBarang').click(function(e){
       e.preventDefault();
       var barcode = $('#barcode').val();
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
     })
  </script>
@endsection
