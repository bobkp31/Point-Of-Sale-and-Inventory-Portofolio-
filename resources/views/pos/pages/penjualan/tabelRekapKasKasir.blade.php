<div class="panel panel-warning">
  <div class="panel-heading">
    Rekap Kas
  </div>

    <table class="table table-hover">
      <thead>
        <tr>
          <th>Username</th>
          <th>Setor</th>
          <th>Waktu Setor</th>
          <th>Rekap</th>
          <th>Waktu Rekap</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($kasKasir as $detailKas)
          <tr>
            <td>{{ $detailKas->username }}</td>
            <td>Rp. {{ number_format($detailKas->setoran,0,'.','.') }}</td>
            <td>{{ $detailKas->waktu_setor }}</td>
            <td>Rp. {{ number_format($detailKas->rekap,0,'.','.') }}</td>
            <td>{{ $detailKas->waktu_rekap}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>


</div>
