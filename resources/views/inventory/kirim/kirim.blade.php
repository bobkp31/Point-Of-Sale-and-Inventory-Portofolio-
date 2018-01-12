@extends('pos.layouts.master')

@section('content')
  <div class="row">
    <div class="col-md-12 panel-warning">
      <div class="content-box-header panel-heading">
          <div class="panel-title">Kirim</div>
      </div>

      <div class="content-box-large">
        <div class="tulisan-tengah">
          <form class="form-inline">
            <div class="form-group">
              <label for="pemasok">Toko</label><br>
              <select class="form-control inline-select" id="toko">
                 <option>AdityaMart Jl.Taman sari</option>
              </select>
              {{-- <input type="text" class="form-control" id="pemasok"> --}}
            </div>

          </form>
        </div>
        <hr>

        <div class="row">
        <div id="kotakKirim">

        </div>
        </div>

      </div>
    </div>
  </div>

  {{-- MODAL EDIT KIRIM BARANG --}}
  <div class="modal fade" id="editKrimBarang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">
            Edit Kirim Barang
          </h4>
        </div>

        <div class="modal-body">
          {{-- AWAL FORM TAMBAH BARANG --}}
          <form class="form-horizontal"
                id="formTambahBarang">
            <input type="hidden" class="form-control" id="editId">
            <div class="form-group">
              <label for="barcode" class="col-sm-2 control-label">Jumlah</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="editJumlah">
              </div>
            </div>


            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="button"
                        class="btn btn-default"
                        id="btn-editDetailKirimBarang">
                      Edit
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

  {{-- END MODAL MODAL EDIT KIRIM  BARANG --}}


<script type="text/javascript">
  $('#kotakKirim').load('/inventory/kirim/formKirim');
</script>
@endsection
