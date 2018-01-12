<style >
table {
  border-collapse: collapse;
  width: 100%;
}
th, td {
    padding: 15px;
    text-align: left;
}
</style>
<center>
<h1>DAFTAR SEMUA BARANG</h1>
</center>
Tanggal : <?php echo date('Y-m-d') ?>
<table border=1>
  <tr>
    <th>Barcode</th>
    <th>Nama Barang </th>
    <th>Kategori</th>
    <th>Hpp</th>
    <th>Harga Jual</th>
    <th>Stok Tersedia</th>
  </tr>
  @foreach ($barang as $bar )
    <tr>
      <td>{{ $bar->barcode }} </td>
      <td>{{ $bar->nama_barang }} </td>
      <td>{{ $bar->kategori }}</td>
      <td>{{ $bar->hpp }}</td>
      <td>{{ $bar->harga_jual }}</td>
      <td>{{ $bar->stok_tersedia}}</td>
    </tr>
  @endforeach
</table>
