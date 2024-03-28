<script src="{{ asset('assets/js/home/config.js') }}"></script>
<script type="text/javascript">
  // Render DataTable
  $(document).ready(function () {
    $('#table_order').DataTable({
      processing: true,
      serverSide: true,
      responsive: false,
      colReorder: true,
      language: language, // from config
      ajax: {
        'url': '{{ url()->current() }}',
      },
      'createdRow': function(row, data, dataIndex){
        $('td:eq(2)', row).css('min-width', '250px');
        $('td:eq(4)', row).css('min-width', '200px');
        $('td:eq(5)', row).css('min-width', '300px');
        $('td:eq(10)', row).css('min-width', '140px');
        $('td:eq(15)', row).css('min-width', '150px');
      },
      columns: [
        { 
          data: 'DT_RowIndex',
          orderable: false,
          searchable: false,
          render: function (data) {
              // Menggunakan fungsi NumberFormat atau format lainnya untuk format ribuan
              return new Intl.NumberFormat('id-ID').format(data);
          }
        },
        { 
          data: 'online_order_id',
          render: function (data) {
            return `<span class="detail-toggle" data-id="${data}">${data}</span>`;
          }  
        },
        { data: 'name' },
        { data: 'phone', searchable: false, },
        { data: 'information', },
        { data: 'address', 
          render: function (data) {
            return (data) ? data : '-';
          }
        },
        { data: 'pick_up_date', searchable: false, 
          render: function (data) {
            var date = new Date(data);
            var options = { day: 'numeric', month: 'long', year: 'numeric' };
            return date.toLocaleDateString('id-ID', options);
          }
        },
        { 
          data: 'pick_up_time', 
          searchable: false,
          render: function (data) {
            return data.substring(0, 5);
          }
        },
        { 
          data: 'estimation_time', 
          searchable: false,
          render: function (data) {
            return data.substring(0, 5);
          }
        },
        { data: "order_status" },
        { data: 'payment_method' },
        { 
          data: 'total', 
          orderable: false,
          searchable: false,
          render: function (data) {
              // Menggunakan fungsi NumberFormat atau format lainnya untuk format ribuan
              var formattedData = new Intl.NumberFormat('id-ID').format(data);
              return 'Rp. ' + formattedData;
          }
        },
        { data: 'payment_status' },
        { 
          data: 'reservation_id', 
          render: function (data) {
              return (data == null) ? '-' : data
          } 
        },
        { data: 'reservation_status' },
        { 
          data: 'actions', 
          orderable: false, 
          searchable: false   
        }
      ],
      columnDefs: [
        { targets: 0, width: '1px', className: "text-nowrap text-center align-middle text-capitalize" },
        { targets: [1], width: '200px', className: "text-nowrap align-middle text-capitalize" },
        { targets: [2], className: "align-middle text-capitalize" },
        { targets: [9, 10, 6, 11, 13, 12], className: "text-nowrap align-middle text-center text-capitalize" },
        { targets: [3, 4, 7, 8, 9, 14, 15, 5], className: "text-center align-middle text-capitalize" },
      ]
    });

    $('body').on('click', '.detail-toggle', function () {
      var id = $(this).data('id');
      detail(id);
    })
  });

  // Fungsi reload datatable
  function reloadTable(id) {
    let table = $(id).DataTable();
    table.cleanData;
    table.ajax.reload();
  }

  // Mengatur token CSRF dalam header permintaan untuk setiap permintaan Ajax
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  function detail(id) { 
    ajaxStart();
    $.ajax({
      url: 'online-order/detail/' + id,
      type: 'GET',
      success: function(response) {
        clearModal();
        $('#id_pesanan').val(response.data.online_order_id);
        $('#status').val(response.data.status);
        $('#name').val(response.data.name);
        $('#phone').val(response.data.phone);
        $('#address').val(response.data.address);
        $('#pick_up_date').val(response.data.pick_up_date);
        $('#pick_up_time').val(response.data.pick_up_time);
        $('#estimation_time').val(response.data.estimation_time);
        $('#total').val(response.data.total);
        $('#payment_method').val(response.data.payment_method);
        if(response.data.payment != null) {
          $('#payment_status').val(response.data.payment.payment_status);
        } else {
          $('#payment_status').val('-');
        }
        if(response.data.reservation != null) {
          $('#reservation_id').val(response.data.reservation.reservation_id);
          $('#reservation_status').val(response.data.reservation.reservation_status);
        } else {
          $('#reservation_id').val('-');
          $('#reservation_status').val('-');
        }

        // Item order
        // template dengan foreeach
        var templateListOrderItem = '';
        var orderItems = response.data.order_items;
        orderItems.forEach((item, index) => {
          var price = item.price.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
          var quantity = item.quantity.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
          
          if(index == 0) {
            templateListOrderItem = 
              `<div class="row">
                <div class="col">
                  <h6 class="text-capitalize">${item.food.name}</h6>
                  <span>${quantity}x </span><span>${price}</span>
                </div>
              </div>
              <hr class="mt-1">
              `
          }else {
            templateListOrderItem += 
              `<div class="row">
                <div class="col">
                  <h6 class="text-capitalize">${item.food.name}</h6>
                  <span>${quantity}x </span><span>${price}</span>
                </div>
              </div>
              <hr class="mt-1">
              `    
          }
        });

        $('#list_item_order').html(templateListOrderItem);
        
        // Item Reservasi
        // template dengan foreeach
        var templateListReservationItem = '';

        if(response.data.reservation) {
          var reservationItems = response.data.reservation.reservation_items;

          reservationItems.forEach((item, index) => {
            if(index == 0) {
              templateListReservationItem = 
                `<div class="row">
                  <div class="col">
                    <h6>Meja nomor ${item.table.id}</h6>
                  </div>
                </div>
                <hr class="mt-1">
                ` 
            }else {
              templateListReservationItem += 
                `<div class="row">
                    <div class="col">
                      <h6>Meja nomor ${item.table.id}</h6>
                    </div>
                </div>
                <hr class="mt-1">
                ` 
            }
          });

          $('#card_reservation_items').html(templateListReservationItem);
        }

        ajaxStop();
        $('#modalOnlineOrder').modal('show');
      },
      error: function(e) {
        ajaxStop();
        console.log('Terjadi kesalahan saat mengambil data');
      }
    });
  }

  function clearModal() {
    $('#reservation_id').val('-');
    $('#reservation_status').val('-');
    $('#card_reservation_items').html('');
    $('#payment_status').val('-');
    $('#list_item_order').html('');
  }

  // Button detail 
  $('body').on('click', '#btn-detail', function(e) {
    ajaxStart();
    let id = $(this).data('id');

    $.ajax({
      url: 'online-order/detail/' + id,
      type: 'GET',
      success: function(response) {
        clearModal();
        $('#id_pesanan').val(response.data.online_order_id);
        $('#status').val(response.data.status);
        $('#name').val(response.data.name);
        $('#phone').val(response.data.phone);
        $('#address').val(response.data.address);

        var date = new Date(response.data.pick_up_date);
        var options = { day: 'numeric', month: 'long', year: 'numeric' };
        var pick_up_date = date.toLocaleDateString('id-ID', options);

        $('#pick_up_date').val(pick_up_date);
        $('#pick_up_time').val(response.data.pick_up_time.substring(0, 5));
        $('#estimation_time').val(response.data.estimation_time.substring(0, 5));
        $('#total').val(response.data.total);
        $('#payment_method').val(response.data.payment_method);
        if(response.data.payment != null) {
          $('#payment_status').val(response.data.payment.payment_status);
        } else {
          $('#payment_status').val('Menunggu pembayaran');
        }
        if(response.data.reservation != null) {
          $('#reservation_id').val(response.data.reservation.reservation_id);
          $('#reservation_status').val(response.data.reservation.reservation_status);
        } else {
          $('#reservation_id').val('-');
          $('#reservation_status').val('-');
        }

        // Item order
        // template dengan foreeach
        var templateListOrderItem = '';
        var orderItems = response.data.order_items;
        orderItems.forEach((item, index) => {
          var price = item.price.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
          var quantity = item.quantity.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
          
          if(index == 0) {
            templateListOrderItem = 
              `<div class="row">
                    <div class="col">
                      <h6 class="text-capitalize">${item.food.name}</h6>
                      <span>${quantity}x </span><span>${price}</span>
                    </div>
                </div>
                <hr class="mt-1">
                `
          }else {
            templateListOrderItem += 
              `<div class="row">
                  <div class="col">
                    <h6 class="text-capitalize">${item.food.name}</h6>
                    <span>${quantity}x </span><span>${price}</span>
                  </div>
                </div>
                <hr class="mt-1">
                `
          }
        });

        $('#list_item_order').html(templateListOrderItem);
        
        // Item Reservasi
        // template dengan foreeach
        var templateListReservationItem = '';

        if(response.data.reservation) {
          var reservationItems = response.data.reservation.reservation_items;

          reservationItems.forEach((item, index) => {
            if(index == 0) {
              templateListReservationItem = 
                `<div class="row">
                  <div class="col">
                    <h6>Meja nomor ${item.table_id}</h6>
                  </div>
                </div>
                <hr class="mt-1">
                `
            }else {
              templateListReservationItem += 
              `<div class="row">
                <div class="col">
                  <h6>Meja nomor ${item.table_id}</h6>
                </div>
                </div>
                <hr class="mt-1">
                `
            }
          });

          $('#card_reservation_items').html(templateListReservationItem);
        }

        ajaxStop();
        $('#modalOnlineOrder').modal('show');
      },
      error: function(e) {
        ajaxStop();
        console.log('Terjadi kesalahan saat mengambil data');
      }
    });
  });

  // Proses Accept 
  $('body').on('click', '#btn-accept', function(e) {
    Swal.fire({
      title: 'Apakah kamu yakin terima pesanan ini?',
      text: "Pesanan yang diterima akan berubah status menjadi 'process' dan statusnya tidak bisa dirubah lagi!",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Terima',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.isConfirmed) {
        ajaxStart();
        var id = $(this).data('id');
        $.ajax({
            url: 'online-order/accept/' + id,
            method: 'GET',
            success: function (res) {
              ajaxStop();
              Swal.fire(
                'Berhasil!',
                res.message,
                'success'
              );
              $('#table_order').DataTable().ajax.reload();
            },
            error: function (err) {
              ajaxStop();
              Swal.fire(
                'Gagal!',
                err.message,
                'error'
              )
            }
        });  
      }
    })
  })  

  // Proses Rejected 
  $('body').on('click', '#btn-rejected', function(e) {
    Swal.fire({
      title: 'Apakah kamu yakin menolak pesanan ini?',
      text: "Pesanan yang ditolak akan berubah status menjadi 'failed' dan statusnya tidak bisa dirubah lagi!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Tolak',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.isConfirmed) {
        ajaxStart();
        var id = $(this).data('id');
        $.ajax({
            url: 'online-order/rejected/' + id,
            method: 'GET',
            success: function (res) {
              ajaxStop();
              Swal.fire(
                'Berhasil!',
                res.message,
                'success'
              );
              $('#table_order').DataTable().ajax.reload();
            },
            error: function (err) {
              ajaxStop();
              Swal.fire(
                'Gagal!',
                err.message,
                'error'
              )
            }
        });

        $('#table_order').DataTable().ajax.reload();
      }
    })
  })  

  // Proses Done Order With Cash 
  $('body').on('click', '#btn-done-cash', function(e) {
    Swal.fire({
      title: 'Apakah kamu yakin selesaikan pesanan ini?',
      text: "Pesanan yang diselesaikan akan berubah status menjadi 'success' dan statusnya tidak bisa dirubah lagi!",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Selesai',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.isConfirmed) {
        ajaxStart();
        var id = $(this).data('id');
        $.ajax({
            url: 'online-order/done-order-cash/' + id,
            method: 'GET',
            success: function (res) {
              ajaxStop();
              Swal.fire(
                'Berhasil!',
                res.message,
                'success'
              );
              $('#table_order').DataTable().ajax.reload();
            },
            error: function (err) {
              ajaxStop();
              Swal.fire(
                'Gagal!',
                err.message,
                'error'
              )
            }
        });  
      }
    })
  })  

  // Proses Done Payment
  $('body').on('click', '#btn-done-payment', function(e) {
    Swal.fire({
      title: 'Apakah kamu yakin selesaikan pembayaran pesanan ini?',
      text: "Pembayaran yang diselesaikan akan berubah status menjadi 'success' dan statusnya tidak bisa dirubah lagi!",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Selesai',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.isConfirmed) {
        ajaxStart();
        var id = $(this).data('id');
        $.ajax({
            url: 'online-order/done-payment/' + id,
            method: 'GET',
            success: function (res) {
              ajaxStop();
              Swal.fire(
                'Berhasil!',
                res.message,
                'success'
              );
              $('#table_order').DataTable().ajax.reload();
            },
            error: function (err) {
              ajaxStop();
              Swal.fire(
                'Gagal!',
                err.message,
                'error'
              )
            }
        });  
      }
    })
  })  

  // Action cetak bukti pembayaran start
  $('body').on('click', '#btn-payment', function (e) {
    var order_id = $(this).data('id');

    var newURL = myApp + '/order/payment/' + order_id.toLowerCase();
    window.open(newURL, '_blank');
  });
  // Action cetak bukti pembayaran end
</script>