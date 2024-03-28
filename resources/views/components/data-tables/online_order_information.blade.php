@if ($estiationStatus == 1 && $data->status == 'pending' || $data->status == 'process')
<span class="text-danger font-italic">Sudah lewat waktu estimasi</span>
@else
-
@endif