@if ($model->reservation)
@if ($model->reservation->reservation_status == 'pending')
<span class="btn-warning text-white font-weight-bolder rounded-lg btn btn-sm mb-0 px-3">
  Tertunda
</span>

@elseif ($model->reservation->reservation_status == 'process')
<span class="btn-info text-white font-weight-bolder rounded-lg btn btn-sm mb-0 px-3">
  Proses
</span>

@elseif ($model->reservation->reservation_status == 'success')
<span class="btn-success text-white font-weight-bolder rounded-lg btn btn-sm mb-0 px-3">
  Berhasil
</span>

@else
<span class="btn-danger text-white font-weight-bolder rounded-lg btn btn-sm mb-0 px-3">
  Gagal
</span>
@endif
@else
-
@endif