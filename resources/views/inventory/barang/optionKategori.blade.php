<select class="form-control" id="kategori">
  @foreach ($kategori as $kat)
  <option>{{ $kat->kategori }}</option>
  @endforeach
</select>
