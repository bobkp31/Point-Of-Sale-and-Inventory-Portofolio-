<table class="table">
    <tr>
      <th>Kategori</th>
      <th>Pilihan</th>
    </tr>
  @foreach ($kategori as $kat)
    <tr>
      <td>{{ $kat->kategori }}</td>
      <td>
        <button type="button"
                name="button"
                class="btn btn-success btn-xs"
                onclick="getId({{ $kat->id }})">
          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
        </button>
      </td>
    </tr>
  @endforeach
</table>
<script type="text/javascript">
  function getId(id){
      // console.log(id);
      $.ajax({
          url  : '/inventory/barang/formEditKategori',
          method : 'get',
          data   : {'id':id},
          success : function(response){
              $('#modalTabelKategori').html(response);
          }
      });
  }
</script>
