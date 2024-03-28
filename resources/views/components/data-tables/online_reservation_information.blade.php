@if ($estiationStatus == 1 && $data->reservation_status == 'pending' || $data->reservation_status == 'process')
<span class="text-danger font-italic">Sudah lewat waktu estimasi</span>
@else
-
@endif