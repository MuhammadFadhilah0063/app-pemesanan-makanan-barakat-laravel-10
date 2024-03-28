@if($model->online_order_id)
<span>{{ $model->online_order_id }}</span>
@else
<span>{{ $model->offline_order_id }}</span>
@endif