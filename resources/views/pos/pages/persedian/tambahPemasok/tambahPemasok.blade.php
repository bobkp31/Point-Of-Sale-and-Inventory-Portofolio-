@extends('pos.layouts.master')

@section('title','Tambah Pemasok')

@section('content')
<div class="jrk-marjin-bwh">
  <button type="button"
          class="btn btn-info"
          data-toggle="modal"
          data-target="#modalTambahPemasok">
        Tambah Pemasok
  </button>
</div>

<!--Tampil daftar Pemasok-->
<div class="row">
  <div class="col-md-12 panel-warning">
  	<div class="content-box-header panel-heading">
  	  <div class="panel-title ">Daftar Pemasok</div>
  	</div>

    <div class="content-box-large box-with-header">
      <!-- Tabel Produk -->
      <div class="table-responsive">
        <table id="dtPemasok" class="table table-hover table-bordered">
          <thead>
            <tr class="warning">
              <th>Id Pemasok</th>
              <th>Nama Pemasok</th>
              <th>Hapus</th>
              <th>Edit</th>
            </tr>
          </thead>
        </table>
      </div>
      <!-- End Tabel Produk -->
    </div>

  </div>
</div>

{{-- <div id="daftarPemasok">
</div> --}}




<script type="text/javascript">
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });

  $.ajax({
    url      : '/pos/persedian/daftarPemasok',
    method   : 'get',
    success  : function(response){
      $('#daftarPemasok').html(response);
    }
  })

  function get_id(id)
  {
    console.log(id)
  }


  // $('#dtPemasok').DataTable({
  //       processing: true,
  //       serverSide: true,
  //       ajax: '/pos/persedian/dataTablesPemasok',
  //       columns: [
  //           {data: 'id_pemasok', name: 'id_pemasok'},
  //           {data: 'nama_pemasok', name: 'nama_pemasok'},
  //           {data: 'hapus', name: 'hapus', orderable: false, searchable: false},
  //           {data: 'pilihan', name: 'pilihan', orderable: false, searchable: false}
  //       ]
  //   });
</script>
@endsection
