@extends('pos.layouts.master')

@section('content')
  <div class="row">
    <div class="col-md-12 panel-warning">
      <div class="content-box-header panel-heading">
          <div class="panel-title">Tambah Faktur</div>
      </div>

      <div class="content-box-large">
        <div class="tulisan-tengah">
          <form class="form-inline">
            <div class="form-group">
              <label for="pemasok">Pemasok</label><br>
              <select class="form-control inline-select" id="idPemasok">
                @foreach ($pemasok as $key)
                   <option value="{{$key->nama_pemasok}}">{{ $key->nama_pemasok }}</option>
                @endforeach
              </select>
              {{-- <input type="text" class="form-control" id="pemasok"> --}}
            </div>

            <div class="form-group">
              <label for="noFaktur">Nomer Faktur</label>
              <input type="text" class="form-control" id="noFaktur">
            </div>
          </form>
        </div>
        <hr>

        <div class="row">
        <div id="kotakTambahFaktur">

        </div>
        </div>

      </div>
    </div>
  </div>

<script type="text/javascript">
  // var noFaktur = $('#noFaktur').val();
  // $.ajax({
  //    url    : '/inventory/faktur/formTambahFaktur',
  //    method : 'get',
  //    data   : {'noFaktur':noFaktur},
  //    success: function(response){
  //         $('#kotakTambahFaktur').html(response);
  //    }
  // })


  //Tekan enter di dalam form nomor faktur
  $('#noFaktur').keypress(function(event){
    //  event.preventDefault();
     var noFaktur = $(this).val();
     var idPemasok = $('#idPemasok').val();
     //Tambah no faktur ke tb_faktur
     if(event.which == 13){
        event.preventDefault();
        $.ajax({
          url    :'/inventory/faktur/tambahFaktur',
          method :'get',
          data   :{'noFaktur'  : noFaktur,
                   'idPemasok' : idPemasok
                  },
          success: function(response){
            if(response == 'kosong'){
               alert('No Faktur Tidak Boleh Kosong !!');
            }else if(response == 'masuk'){
              $('#kotakTambahFaktur').load('/inventory/faktur/formTambahFaktur');
            }else if(response == 'sudah ada'){
              $.ajax({
                 url    : '/inventory/faktur/formTambahFaktur',
                 method : 'get',
                 data   : {
                           'noFaktur':noFaktur,
                           'idPemasok' : idPemasok
                           },
                 success: function(response){
                      $('#kotakTambahFaktur').html(response);
                 }
              })

            }

          }
        })
     }
  })

</script>
@endsection
