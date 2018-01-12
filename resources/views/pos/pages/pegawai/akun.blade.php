@extends('pos.layouts.master')

@section('title','Akun')

@section('content')
  <div class="jrk-marjin-bwh">
    <button type="button"
            class="btn btn-info"
            data-toggle="modal"
            data-target="#modalTambahPegawai">
            Tambah Pegawai
    </button>
  </div>

<div class="row">
  <div class="col-md-6 panel-warning">
    <div class="content-box-header panel-heading">
      <div class="panel-title">Tambah ddAkun</div>
    </div>

    <div class="content-box-large">
      <div class="panel-body">
         <!-- Begin Form -->
         <form method="post" action="/storeProduct" class="form-horizontal" role="form">
           <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="idPegawai" class="col-sm-2 control-label">idPegawai</label>
                <div class="col-sm-10">
                      <input type="text" name='idPegawai' class="form-control" id="idPegawai" placeholder="PGW001">
                </div>
            </div>

            <div class="form-group">
                <label for="namaPegawai" class="col-sm-2 control-label">Nama Pegawai</label>
                <div class="col-sm-10">
                      <input type="text" name='namaPegawai' class="form-control" id="namaPegawai" placeholder="Anton Medan .Msc">
                </div>
            </div>

            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-10">
                      <input type="text" name='username' class="form-control" id="username" placeholder="Anton55">
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                      <input type="text" name='password' class="form-control" id="password" placeholder="******">
                </div>
            </div>

            <div class="form-group">
  						<div class="col-sm-offset-2 col-sm-10">
  							<button type="submit" class="btn btn-primary">Tambah</button>
  						</div>
  					</div>

         </form>
         <!-- End Form -->
      </div>
    </div>
  </div>
</div>



  <div class="row">
    <div class="col-md-12 panel-warning">
  	   <div class="content-box-header panel-heading">
  	  		<div class="panel-title ">Daftar Pegawai</div>
  		 </div>

       <div class="content-box-large box-with-header">
         <!-- Tabel Produk -->
         <div class="table-responsive ">
           <table class="table table-hover table-bordered">
             <tr>
               <th>Id Pegawai</th>
               <th>Nama Pegawai</th>
               <th>Username</th>
               <th>Password</th>
               <th>Pilihan</th>
             </tr>
             <tr>
               <td>PGW001</td>
               <td>Uden Jengot</td>
               <td>Uden66</td>
               <td>*****</td>
               <td>edit</td>
             </tr>
           </table>
         </div>
         <!-- Akhir Tabel Produk -->
  		 </div>

  	</div>
  </div>

@endsection
