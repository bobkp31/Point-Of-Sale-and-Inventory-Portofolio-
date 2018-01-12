@extends('pos.layouts.master')

@section('title','Tambah Produk')

@section('content')
<div class="jrk-marjin-bwh">
  <button type="button"
          class="btn btn-info"
          data-toggle="modal"
          data-target="#modalTambahProduk">
        Tambah Produk
  </button>
</div>

<!-- Tampil daftar Produk -->
<div id="daftarProduk">
</div>

<!-- Modal Tambah Produk -->
<div class="modal fade" id="modalTambahProduk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
          Tambah Produk
        </h4>
      </div>

      <div class="modal-body">
        <!-- Begin Form -->
        <form method="post" class="form-horizontal" role="form" id="formTambahProduk">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
           <div class="form-group">
               <label for="barcode" class="col-sm-2 control-label">Barcode</label>
               <div class="col-sm-10">
                     <input type="text"
                            name='fIbarcode'
                            class="form-control"
                            id="fIbarcode">
               </div>
           </div>

          {{--
           <div class="form-group">
               <label for="kd_barang" class="col-sm-2 control-label">Kode Barang</label>
               <div class="col-sm-10">
                     <input type="text"
                            name='fIkd_barang'
                            class="form-control"
                            id="fIkd_barang">
               </div>
           </div> --}}

           <div class="form-group">
               <label for="nama_barang" class="col-sm-2 control-label">Nama Barang</label>
               <div class="col-sm-10">
                     <input type="text"
                            name='fInama_barang' class="form-control"
                            id="fInama_barang">
               </div>
           </div>

           <div class="form-group">
               <label for="hpp" class="col-sm-2 control-label">Hpp</label>
               <div class="col-sm-10">
                     <input type="text"
                            class="form-control"
                            id="fIhpp">
               </div>
           </div>

           <div class="form-group">
               <label for="harga_jual" class="col-sm-2 control-label">Harga Jual</label>
               <div class="col-sm-10">
                     <input type="text"
                            class="form-control"
                            id="fIharga_jual">
               </div>
           </div>


           <div class="form-group">
             <div class="col-sm-offset-2 col-sm-10">
               <button type="button"
                       id="btn-tambahProduk"
                       class="btn btn-primary"
                       data-dismiss="modal">
                      Tambah
               </button>
             </div>
           </div>
        </form>
        <!-- End Form -->
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>

    </div>
  </div>
</div>
<!-- End Modal Tambah Produk -->


<!-- Modal  Edit Produk-->
<div class="modal fade" id="modalEditProduk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">
          Edit Produk
        </h4>
      </div>

      <div class="modal-body">
        <form action="#" method="post">
          <input type="hidden" id="inp_idStok">
          <div class="form-group">
            <label for="barcode">Barcode</label>
            <input type="text" id="inp_barcode" name="barcode" class="form-control" disabled>
          </div>

          {{-- <div class="form-group">
            <label for="barcode">Kode Barang</label>
            <input type="text" id="inp_kdBarang" name="kdBarang" class="form-control">
          </div> --}}

          <div class="form-group">
            <label for="barcode">Nama Barang</label>
            <input type="text" id="inp_namaBarang" name="namaBarang" class="form-control">
          </div>

          <div class="form-group">
              <label for="hpp" class="col-sm-2 control-label">Hpp</label>
              <input type="text"
                     class="form-control"
                     id="inp_hpp">
          </div>


          <div class="form-group">
            <label for="hargaJual">Harga Jual</label>
            <input type="text" id="inp_hargaJual" name="hargaJual" class="form-control">
          </div>

          <div class="form-group">
            <label for="hargaJual">Jumlah</label>
            <input type="text" id="inp_jumlah" name="jumlah" class="form-control">
          </div>

          <button type="button" id="btn-editProduk" name="button" class="btn btn-primary" data-dismiss="modal">Edit</button>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>

    </div>
  </div>
</div>


<script type="text/javascript">
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  //Tampil Daftar produk
  $.ajax({
    url : '/pos/persedian/daftarProduk',
    method : 'get',
    success : function(response){
      $('#daftarProduk').html(response);
    }
  })
  //
  //

  function get_barcode(id)
  {
    //console.log(id);
    $.ajax({
      url : 'getBarcode',
      method : 'get',
      data : {'id' : id},
      success : function(result){
        //console.log(result);
        $('#inp_idStok').val(result[0].id_stok);
        $('#inp_barcode').val(result[0].barcode);
        $('#inp_namaBarang').val(result[0].nama_barang);
        $('#inp_hpp').val(result[0].hpp);
        $('#inp_hargaJual').val(result[0].harga_jual);
        $('#inp_jumlah').val(result[0].jumlah);
      }
    })
  }
  //
  //edit produk
  $('#btn-editProduk').click(function(){
    var idStok     = $('#inp_idStok').val();
    var barcode    = $('#inp_barcode').val();
    var hpp        = $('#inp_hpp').val();
    var namaBarang = $('#inp_namaBarang').val();
    var hargaJual  = $('#inp_hargaJual').val();
    var jumlah     = $('#inp_jumlah').val();
    // console.log(hpp);

    $.ajax({
      url : '/pos/persedian/editProduk',
      method : 'get',
      data : {'idStok'     : idStok,
              'barcode'    : barcode,
              'hpp'        : hpp,
              'namaBarang' : namaBarang,
              'hargaJual'  : hargaJual,
              'jumlah'     : jumlah
              },
      success : function(result){
        console.log(result);
        $('#daftarProduk').load('/pos/persedian/daftarProduk');
      }
    })
  })

  //tambah Produk
  $('#btn-tambahProduk').click(function(){

    var barcode    = $('#fIbarcode').val();
    var kdBarang   = $('#fIkd_barang').val();
    var namaBarang = $('#fInama_barang').val();
    var hpp        = $('#fIhpp').val();
    var hargaJual  = $('#fIharga_jual').val();

    $.ajax({
      url : '/pos/persedian/menambahkanProduk',
      method : 'get',
      data : {'barcode'    : barcode,
              'kdBarang'   : kdBarang,
              'namaBarang' : namaBarang,
              'hpp' : hpp,
              'hargaJual'  : hargaJual
              },
      success : function(result){
        console.log(result);
        $('#formTambahProduk').trigger('reset');
        $('#daftarProduk').load('/pos/persedian/daftarProduk');
      }
    })
  })

  //hapus Produk
  function hapusProduk(id){
    var validasi = confirm("Hapus ?");

    if (validasi == true){
      $.ajax({
        url: '/pos/persedian/hapusProduk',
        method : 'get',
        data : {'id': id },
        success : function(result){
          //console.log(result);
          $('#daftarProduk').load('/pos/persedian/daftarProduk');
        }
      })
    }
  }

</script>
@endsection
