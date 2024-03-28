@foreach ($carts as $item)
<li class="list-group-item">
  <div class="row row-list-cart">
    <div class="col-1 d-grid m-auto ps-2">
      <input class="form-check-input checkCart" type="checkbox" value="" aria-label="..."
        data-food-id="{{ $item->food_id }}" data-cart-id="{{ $item->id }}" />
    </div>
    <div class="col-7 d-grid my-auto">
      <span class="mt-1">{{ $item->food->name }}</span>
    </div>
    <div class="col-4 text-end d-grid my-auto px-1">
      <div class="input-group">
        <button id="btn_decrement" type="button" class="btn d-inline btn-outline-primary btn-sm fw-bold .btn-min">
          <i class="fa-solid fa-xs fa-minus"></i>
        </button>
        <input type="text" style="font-size: 0.8em" class="form-control text-center p-1 input-quantity" placeholder="0"
          value="{{ $item->quantity }}" data-food-id=" {{ $item->food_id }}" data-user-id="{{ $item->user_id }}">
        <button id="btn_increment" type="button" class="btn d-inline btn-outline-primary btn-sm fw-bold .btn-plus">
          <i class="fa-solid fa-xs fa-plus"></i>
        </button>
      </div>
    </div>
  </div>
</li>
@endforeach