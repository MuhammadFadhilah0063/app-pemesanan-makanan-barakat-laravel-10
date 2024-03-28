<div class="row mt-2">
  <div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item shadow-sm bg-white">
      <h2 class="accordion-header" id="flush-headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
          data-bs-target="#flush-collapse{{ $loop->iteration }}" aria-expanded="false"
          aria-controls="flush-collapse{{ $loop->iteration }}">
          Rincian reservasi
        </button>
      </h2>

      {{-- Accordion body start --}}
      <div id="flush-collapse{{ $loop->iteration }}" class="accordion-collapse collapse"
        aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body px-1 py-2">
          {{-- Data reservation start --}}
          <div class="p-2">
            <div
              class="row mb-4 row-countdown @if($reservation->reservation_status == 'success' || $reservation->reservation_status == 'failed') d-none @endif">
              {{-- Hitung mundur --}}
              <input type="hidden" name="countdown_time" id="countdown_time" class="countdown-time"
                value="{{ $reservation->reservation_date }}  {{ $reservation->estimation_time }}">
              <div class="col-12 text-center text-md-end countdown-timer"></div>
            </div>

            <div class="row">
              <div class="col-12 col-sm-7">
                <div class="mb-3">
                  <label class="form-label">Nama</label>
                  <input readonly type="text" class="form-control fw-bold" value="{{ $reservation->name }}">
                </div>
              </div>
              <div class="col-12 col-sm-5">
                <div class="mb-3">
                  <label class="form-label">No. Telp</label>
                  <input readonly type="text" class="form-control fw-bold" value="{{ $reservation->phone }}">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12 col-lg-4 col-sm-6">
                <div class="mb-3">
                  <label class="form-label">Tanggal Reservasi</label>
                  <input readonly class="form-control fw-bold" value="{{ formatDate($reservation->reservation_date) }}">
                </div>
              </div>
              <div class="col-12 col-lg-4 col-sm-6">
                <div class="mb-3">
                  <label class="form-label">Jam Reservasi</label>
                  <input readonly type="time" class="form-control fw-bold" value="{{ $reservation->reservation_time }}">
                </div>
              </div>
              <div class="col-12 col-lg-4 col-sm-6">
                <div class="mb-3">
                  <label class="form-label">Estimasi Waktu</label>
                  <input readonly type="time" class="form-control fw-bold" value="{{ $reservation->estimation_time }}">
                </div>
              </div>
            </div>
          </div>
          {{-- Data reservation end --}}

          {{-- List items start --}}
          <div class="card mx-2">
            <div class="card-body">
              @foreach ($reservation->reservation_items as $item)
              <div class="row d-flex align-items-center align-items-stretch">
                <div class="col-12 col-sm-4 col-md-4 col-lg-3 col-xl-2">
                  <img class="flex-shrink-0 img-fluid rounded-3 shadow-sm" src="{{ $item->table->image }}"
                    alt="Gambar meja" />
                </div>
                <div class="col-12 col-sm-8 col-md-8 col-lg-9 col-xl-10">
                  <div class="d-flex flex-column text-start px-1 pt-3 pt-md-0">
                    <div class="row d-flex justify-content-between">
                      <div class="col-10 pe-0">
                        <h5>Meja nomor {{ $item->table->id }}</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              @endforeach

              <!-- Total -->
              <div class="row d-flex px-3 mt-4 fw-bold mb-2">
                <div class="col">
                  <span>Total</span>
                </div>
                <div class="col text-end">
                  <span class="text-nowrap">{{ ribu(count($reservation->reservation_items)) }} meja</span>
                </div>
              </div>
            </div>
          </div>
          {{-- List items end --}}

          {{-- Online order start --}}
          @if ($reservation->online_order)
          {{-- Data order start --}}
          <div class="p-2 mt-3">
            <div class="row">
              <div class="col-12 col-md-8">
                <div class="mb-3">
                  <label class="form-label">Nomor Pesanan</label>
                  <input readonly type="text" class="form-control fw-bold"
                    value="{{ $reservation->online_order->online_order_id }}">
                </div>
              </div>
              <div class="col-12 col-md-4">
                <div class="mb-3">
                  <label class="form-label">Status Pesanan</label>
                  <input readonly type="text" class="form-control fw-bold"
                    value="{{ $reservation->online_order->status }}">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label class="form-label">Pembayaran</label>
                  <input readonly type="text" class="form-control fw-bold"
                    value="{{ ($reservation->online_order->payment_method == 'cash') ? 'COD' : 'Virtual' }}">
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label class="form-label">Status Pembayaran</label>
                  <input readonly type="text" class="form-control fw-bold"
                    value="{{ $reservation->online_order->payment->payment_status }}">
                </div>
              </div>
            </div>
          </div>
          {{-- Data order end --}}

          {{-- List order items start --}}
          <div class="card mx-2">
            <div class="card-body">
              @foreach ($reservation->online_order->order_items as $item)
              <div class="row d-flex align-items-center align-items-stretch">
                <div class="col-12 col-sm-4 col-md-4 col-lg-3 col-xl-2">
                  <img class="flex-shrink-0 img-fluid rounded-3 shadow-sm" src="{{ $item->food->image }}"
                    alt="Gambar makanan" />
                </div>
                <div class="col-12 col-sm-8 col-md-8 col-lg-9 col-xl-10">
                  <div class="d-flex flex-column text-start px-1 pt-3 pt-md-0">
                    <div class="row d-flex justify-content-between">
                      <div class="col-10 pe-0">
                        <h5>{{ $item->food->name }}</h5>
                      </div>
                    </div>

                    <div class="d-flex justify-content-between">
                      <span>{{ ribu($item->quantity) }}x {{ ribu($item->price) }}</span>
                      <span>{{ ribu(($item->quantity * $item->price)) }}</span>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              @endforeach

              <!-- Total -->
              <div class="row d-flex px-3 mt-4 fw-bold mb-2">
                <div class="col">
                  <span>Total</span>
                </div>
                <div class="col text-end">
                  <span class="text-nowrap">{{ rupiah($reservation->online_order->total) }}</span>
                </div>
              </div>
            </div>
          </div>
          {{-- List order items end --}}
          @endif
          {{-- Online order end --}}

          {{-- Button cancel and pay reservation start --}}
          @if ($reservation->reservation_status == 'pending')
          <div class="row my-3 px-2 justify-content-center">
            <div class="col text-end d-grid d-md-block">
              {{-- Cancel Button --}}
              <button data-id="{{ $reservation->reservation_id }}"
                class="btn btn-danger fw-bold rounded-3 shadow-sm text-nowrap btn-denied-reservation me-0 me-md-1">
                Batalkan
              </button>

              {{-- Pay Button - midtrans start --}}
              @if ($reservation->online_order)
              @if ($reservation->online_order->payment->payment_status == 'pending' &&
              $reservation->online_order->payment_method == 'virtual')
              <button data-snap-token="{{ $reservation->online_order->snap_token }}"
                class="btn btn-primary fw-bold rounded-3 shadow-sm text-nowrap mt-2 mt-md-0 btn-pay">
                Bayar
              </button>
              @endif
              @endif
              {{-- Pay Button - midtrans end --}}
            </div>
          </div>

          @elseif ($reservation->reservation_status == 'process')
          <div class="row my-3 px-2 justify-content-center">
            <div class="col text-end d-grid d-md-block">
              {{-- Accept Button --}}
              <button data-id="{{ $reservation->reservation_id }}"
                class="btn btn-success fw-bold rounded-3 shadow-sm text-nowrap btn-accept-reservation me-0 me-md-1">
                Selesai
              </button>

              {{-- Pay Button - midtrans start --}}
              @if ($reservation->online_order)
              @if ($reservation->online_order->payment->payment_status == 'pending' &&
              $reservation->online_order->payment_method == 'virtual')
              <button data-snap-token="{{ $reservation->online_order->snap_token }}"
                class="btn btn-primary fw-bold rounded-3 shadow-sm text-nowrap mt-2 mt-md-0 btn-pay">
                Bayar
              </button>
              @endif
              @endif
              {{-- Pay Button - midtrans end --}}
            </div>
          </div>
          @endif
          {{-- Button cancel and pay reservation end --}}

          {{-- Button Cetak Bukti Pembayaran start --}}
          @if ($reservation->online_order)
          @if ($reservation->online_order->status == 'success' && $reservation->online_order->payment->payment_status ==
          'success')
          <div class="row my-3 px-2 justify-content-center">
            <div class="col text-end d-grid d-md-block">
              <button data-id="{{ $reservation->online_order->online_order_id }}"
                class="btn btn-info fw-bold rounded-3 shadow-sm text-nowrap btn-payment">
                Bukti Pembayaran
              </button>
            </div>
          </div>
          @endif
          @endif
          {{-- Button Cetak Bukti Pembayaran end --}}
        </div>
      </div>
      {{-- Accordion body end --}}
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('.row-countdown').each(function() {
      var countdownTime = $(this).find('.countdown-time').val();
      countdown($(this).find('.countdown-timer'), countdownTime);
    });
  });

  // Fungsi hitung waktu mundur
  function countdown(element, endTime) {
    var days, hours, minutes, seconds;
    
    var endDate = new Date(endTime).getTime();
    
    if (isNaN(endDate)) {
      return;
    }
    
    setInterval(calculate, 1000);
    
    function calculate() {
      var startDate = new Date();
      startDate = startDate.getTime();
      
      var timeRemaining = parseInt((endDate - startDate) / 1000);
      
      if (timeRemaining >= 0) {
        days = parseInt(timeRemaining / 86400);
        timeRemaining = timeRemaining % 86400;
        
        hours = parseInt(timeRemaining / 3600);
        timeRemaining = timeRemaining % 3600;
        
        minutes = parseInt(timeRemaining / 60);
        timeRemaining = timeRemaining % 60;
        
        seconds = parseInt(timeRemaining);
        
        var countdownHtml = '';

        var countdownHtml = '<span class="fst-italic fw-bold" style="color: rgba(202, 6, 6, 0.775)">Waktu estimasi: ';

        if (days > 0) {
            countdownHtml += days + ' hari, ';
        } 
        if (hours > 0 || days > 0) {
            countdownHtml += hours + ' jam, ';
        }
        if (minutes > 0 || hours > 0 || days > 0) {
            countdownHtml += minutes + ' menit, ';
        }

        countdownHtml += seconds + ' detik</span>';

        element.html(countdownHtml);
      } else {
        // Jika waktu mundur telah selesai
        element.html(`<span class="fst-italic fw-bold" style="color: rgba(202, 6, 6, 0.775)">Waktu estimasi: Sudah lewat batas waktu estimasi`);
      }
    }
  }
  
</script>