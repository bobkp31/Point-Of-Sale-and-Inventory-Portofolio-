<table class="table table-hover">
      <thead>
        <tr>
          <th>Kode Barang</th>
          <th>Nama Barang</th>
          <th>Jumlah Item</th>
          <th>Potongan</th>
          <th>Harga</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($tb_transaksi as $transaksi)
          <tr>

            <td>{{ $transaksi->barcode  }}</td>
            <td>{{ $transaksi->nama_barang }}</td>
            <td>{{ $transaksi->qty }}</td>
            <td>{{ $transaksi->nilai_diskon }}</td>
            <td>{{ number_format($transaksi->harga_jual, 0, '.', '.') }}</td>
          </tr>
        @endforeach
      </tbody>
</table>
