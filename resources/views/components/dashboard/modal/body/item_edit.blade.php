<div class="row row-item" data-selling-id="{{ $item->selling_id }}">
  <div class="col">
    <h6 class="selling-name">{{ $item->selling->name }}</h6>
    <div class="row mt-1">
      <div class="col-4 d-flex align-items-center">
        <input id="qty" type="text" class="form-control form-control-sm qty-item" aria-label="Sizing example input"
          aria-describedby="inputGroup-sizing-sm" placeholder="Jumlah" value="{{ $item->quantity }}" onchange="total()">
      </div>
      <div class="px-0 col d-flex align-items-center">
        <input id="price" type="text" class="form-control form-control-sm qty-item" aria-label="Sizing example input"
          aria-describedby="inputGroup-sizing-sm" placeholder="Harga" value="{{ $item->price }}" onchange="total()">
      </div>
    </div>
  </div>
</div>
<hr class="mt-3">