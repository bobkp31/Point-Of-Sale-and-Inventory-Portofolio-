<div class="col-md-8 panel-info">
  <div class="content-box-header panel-heading">
    <div class="panel-title ">Tampil Diskon Penjualan</div>

    <div class="panel-options">
      <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
      <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
    </div>
  </div>

  <div class="content-box-large box-with-header">
    <div class="table-responsive">
      <table id="dtDiskonItem" class="table table-hover">
        <thead>
          <tr>
            <th>Minimum Pembelian</th>
            <th>Diskon </th>
            <th>Persentase</th>
            <th>Rupiah</th>
            <th>Tanggal Berlaku</th>
            <th>Tanggal Berakhir</th>
            <th>Edit</th>
          </tr>
        </thead>
        <tbody>
          @foreach($diskonPenjualans as $diskon)
            <tr>
              <td>{{ $diskon->minimum_pembelian}}</td>
              <td>{{ $diskon->nilai_diskon}}</td>
              <td>{{ $diskon->persentase}}</td>
              <td>{{ $diskon->rupiah}}</td>
              <td>{{ $diskon->tgl_berlaku}}</td>
              <td>{{ $diskon->tgl_berakhir}}</td>
              <td>
                <button class="btn btn-xs btn-primary"
                        data-toggle="modal"
                        data-target="#modalEditDiskonPenjualan"
                        onclick="getIdDiskonPenjualan({{ $diskon->id_induk_diskon_penjualan }})">
                  Edit
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>






<script type="text/javascript">
    function getIdDiskonPenjualan(id){
      // alert(id);
      $.ajax({
        url : '/pos/diskon/getIdDiskonPenjualan',
        method : 'get',
        data   : {'id' : id},
        success : function(response){
          console.log(response);
          $('#editId').val(response[0].id_induk_diskon_penjualan);
          $('#editMinimumPembelian').val(response[0].minimum_pembelian);
          if(response[0].nilai_diskon == 'persentase'){
            $('#op1').attr('selected','selected');
            $('#EditNilai').val(response[0].persentase);
          }else if (response[0].nilai_diskon == 'rupiah') {
            $('#op2').attr('selected','selected');
            $('#EditNilai').val(response[0].rupiah);
          }
          var waktuBerlaku  = response[0].tgl_berlaku.split(" ");
          var waktuBerakhir = response[0].tgl_berakhir.split(" ");

          $('#EditTanggalBerlaku').val(waktuBerlaku[0]);
          $('#EditTanggalBerakhir').val(waktuBerakhir[0]);

          $('#EditJamBerlaku').val(waktuBerlaku[1]);
          $('#EditJamBerakhir').val(waktuBerakhir[1]);

        }
      })
    }


</script>
