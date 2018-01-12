<div class="row">
  <div class="col-md-12 panel-warning">
  	{{-- <div class="content-box-header panel-heading">
  	  <div class="panel-title ">Cetak Faktur</div>
  	</div> --}}

    <div class="content-box-large box-with-header">

      <table class="table">
        <tr>
          <th>Pemasok</th>
          <th>No Faktur </th>
          <th>Tgl Order</th>
          <th>Tgl Jatuh Tempo</th>
          <th>Nomor Order</th>
          <th>keterangan</th>
        </tr>
        <tr>
          <td id="pemasok">{{ $detailFaktur[0]->nama_pemasok}} </td>
          <td id="noFaktur">{{ $detailFaktur[0]->no_faktur}} </td>
          <td>{{ $detailFaktur[0]->tanggal_order}}</td>
          <td>{{ $detailFaktur[0]->tanggal_jatuh_tempo}}</td>
          <td>{{ $detailFaktur[0]->no_order}}</td>
          <td>{{ $detailFaktur[0]->keterangan}}</td>
        </tr>
      </table>

      <table class="table table-bordered">
        <tr>
          <th>Barcode</th>
          <th>Nama Barang</th>
          <th>Jumlah Satuan</th>
          <th>Harga Satuan</th>
        </tr>
        @foreach ($detailFaktur as $faktur)
          <tr>
            <td>{{ $faktur->barcode }} </td>
            <td>{{ $faktur->nama_barang }}</td>
            <td>{{ $faktur->jumlah_barang }}</td>
            <td>{{ $faktur->harga_satuan }}</td>
          </tr>
        @endforeach
        <tr>
          <th>Total Harga</th>
          <th>{{ $detailFaktur[0]->total_harga }}</th>
        </tr>
        <tr>
          <th>Total Potongan</th>
          <th>{{ $detailFaktur[0]->total_potongan }}</th>
        </tr>
        <tr>
          <th>Total Tagihan</th>
          <th>{{ $detailFaktur[0]->total_tagihan }}</th>
        </tr>
      </table>
    </div>

    <button class="btn btn-default" name="button" id="btnCetakFaktur">Cetak</button>
  </div>
</div>

<script type="text/javascript">
  $('#btnCetakFaktur').click(function(){
    var noFaktur = $('#noFaktur').html();
    var pemasok = $('#pemasok').html();

    var page = window.open('/inventory/faktur/cetakFaktur/'+noFaktur+'/'+pemasok+'','popupwindow','scrollbars=yes, width=750,height=600');
    page.print();

  })
</script>
