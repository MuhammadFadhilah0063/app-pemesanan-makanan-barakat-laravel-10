<script type="text/javascript">
  // Render DataTable
  $(document).ready(function () {
    $('#table_reservation').DataTable({
      processing: true,
      serverSide: true,
      responsive: false,
      colReorder: true,
      language: language, // from config
      createdRow: function(row, data, dataIndex){
        $('td:eq(3)', row).css('min-width', '250px');
        $('td:eq(4)', row).css('min-width', '180px');
        $('td:eq(5)', row).css('min-width', '200px');
        $('td:eq(6)', row).css('min-width', '110px'); 
        $('td:eq(11)', row).css('min-width', '140px');
        $('td:eq(13)', row).css('min-width', '150px');
      },
      ajax: {
        'url': '{{ url()->current() }}',
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
          data: 'reservation_id',
          render: function (data) {
            return `<span class="detail-toggle" data-id="${data}">${data}</span>`;
          } 
        },
        { data: "reservation_status" },
        { data: 'name' },
        { data: 'phone' },
        { data: 'information' },
        { 
          data: 'reservation_date', 
          searchable: false, 
          render: function (data) {
            var date = new Date(data);
            var options = { day: 'numeric', month: 'long', year: 'numeric' };
            return date.toLocaleDateString('id-ID', options);
          }
        },
        { 
          data: 'reservation_time', 
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
        { 
          data: 'online_order.online_order_id', 
          render: function(data) {
            if (data) {
              return data;
            } else {
              return '-';
            }
          } 
        },
        { data: "order_status" },
        { 
          data: 'online_order.payment_method', 
          render: function(data) {
            if (data) {
              return data;
            } else {
              return '-';
            }
          } 
        },
        { 
          data: 'online_order.total', 
          orderable: false,
          searchable: false,
          render: function (data) {
            if (data) {
              // Menggunakan fungsi NumberFormat atau format lainnya untuk format ribuan
              var formattedData = new Intl.NumberFormat('id-ID').format(data);
              return 'Rp. ' + formattedData;
            } else {
              return '-';
            }
          }
        },
        { data: 'payment_status', },
        { 
          data: 'actions', 
          orderable: false, 
          searchable: false   
        }
      ],
      columnDefs: [
        { targets: 0, width: '1px', className: "text-center align-middle text-capitalize" },
        { targets: 1, width: '200px', className: "align-middle text-capitalize text-nowrap" },
        { targets: [8, 9], width: '200px', className: "align-middle text-capitalize text-nowrap text-center" },
        { targets: [2, 4, 6, 7, 8, 10, 11, 12, 13, 14], width: '80px', className: "text-center align-middle text-capitalize text-nowrap" },
        { targets: [3], className: "align-middle text-capitalize" },
        { targets: [5], className: "align-middle text-capitalize text-center" },
      ]
    });

    $('body').on('click', '.detail-toggle', function () {
      var id = $(this).data('id');
      detail(id);
    })
  });

  // fungsi detail reservasi
  function detail(id) { 
    ajaxStart();
    $.ajax({
      url: 'online-reservation/detail/' + id,
      type: 'GET',
      success: function(response) {
        clearModal();
        $('#id_reservation').val(response.data.reservation_id);
        $('#status').val(response.data.reservation_status);
        $('#name').val(response.data.name);
        $('#phone').val(response.data.phone);

        var date = new Date(response.data.reservation_date);
        var options = { day: 'numeric', month: 'long', year: 'numeric' };
        var reservation_date = date.toLocaleDateString('id-ID', options);

        $('#reservation_date').val(reservation_date);
        $('#reservation_time').val(response.data.reservation_time.substring(0, 5));
        $('#estimation_time').val(response.data.estimation_time.substring(0, 5));
        if(response.data.online_order != null) {
          $('#total').val(response.data.online_order.total);
          $('#payment_method').val(response.data.online_order.payment_method);
          $('#payment_status').val(response.data.online_order.payment.payment_status);
          $('#order_id').val(response.data.online_order.online_order_id);
          $('#order_status').val(response.data.online_order.status);
        } else {
          $('#total').val('-');
          $('#payment_method').val('-');
          $('#payment_status').val('-');
          $('#order_id').val('-');
          $('#order_status').val('-');
        }

        // Item reservation
        // template dengan foreeach
        var templateListReservationItem = '';
        var reservationItems = response.data.reservation_items;
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

        // Item order
        // template dengan foreeach
        if(response.data.online_order) {
          var templateListOrderItem = '';
          var orderItems = response.data.online_order.order_items;
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

          $('#card_order_items').html(templateListOrderItem);
        }
        
        ajaxStop();
        $('#modalOnlineReservation').modal('show');
      },
      error: function(e) {
        ajaxStop();
        console.log('Terjadi kesalahan saat mengambil data');
      }
    });
  }

  // fungsi hapus isi pada modal
  function clearModal() {
    $('#id_reservation').val('');
    $('#status').val('');
    $('#name').val('');
    $('#phone').val('');
    $('#reservation_date').val('');
    $('#reservation_time').val('');
    $('#estimation_time').val('');

    $('#total').val('-');
    $('#payment_method').val('-');
    $('#payment_status').val('-');
    $('#order_id').val('-');
    $('#order_status').val('-');

    $('#card_reservation_items').html('');
    $('#card_order_items').html('');
  }

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

  // Button detail 
  $('body').on('click', '#btn-detail', function(e) {
    ajaxStart();
    let id = $(this).data('id');

    $.ajax({
      url: 'online-reservation/detail/' + id,
      type: 'GET',
      success: function(response) {
        clearModal();
        $('#id_reservation').val(response.data.reservation_id);
        $('#status').val(response.data.reservation_status);
        $('#name').val(response.data.name);
        $('#phone').val(response.data.phone);

        var date = new Date(response.data.reservation_date);
        var options = { day: 'numeric', month: 'long', year: 'numeric' };
        var reservation_date = date.toLocaleDateString('id-ID', options);

        $('#reservation_date').val(reservation_date);
        $('#reservation_time').val(response.data.reservation_time.substring(0, 5));
        $('#estimation_time').val(response.data.estimation_time.substring(0, 5));
        if(response.data.online_order != null) {
          $('#total').val(response.data.online_order.total);
          $('#payment_method').val(response.data.online_order.payment_method);
          $('#payment_status').val(response.data.online_order.payment.payment_status);
          $('#order_id').val(response.data.online_order.online_order_id);
          $('#order_status').val(response.data.online_order.status);
        } else {
          $('#total').val('-');
          $('#payment_method').val('-');
          $('#payment_status').val('-');
          $('#order_id').val('-');
          $('#order_status').val('-');
        }

        // Item reservation
        // template dengan foreeach
        var templateListReservationItem = '';
        var reservationItems = response.data.reservation_items;
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

        // Item order
        // template dengan foreeach
        if(response.data.online_order) {
          var templateListOrderItem = '';
          var orderItems = response.data.online_order.order_items;
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

          $('#card_order_items').html(templateListOrderItem);
        }
        
        ajaxStop();
        $('#modalOnlineReservation').modal('show');
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
      title: 'Apakah kamu yakin terima reservasi ini?',
      text: "Reservasi yang diterima akan berubah status menjadi 'process' dan statusnya tidak bisa dirubah lagi!",
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
            url: 'online-reservation/accept/' + id,
            method: 'GET',
            success: function (res) {
              ajaxStop();
              Swal.fire(
                'Berhasil!',
                res.message,
                'success'
              );
              $('#table_reservation').DataTable().ajax.reload();
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
      title: 'Apakah kamu yakin menolak reservasi ini?',
      text: "Reservasi yang ditolak akan berubah status menjadi 'failed' dan statusnya tidak bisa dirubah lagi!",
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
            url: 'online-reservation/rejected/' + id,
            method: 'GET',
            success: function (res) {
              ajaxStop();
              Swal.fire(
                'Berhasil!',
                res.message,
                'success'
              );
              $('#table_reservation').DataTable().ajax.reload();
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

  // Proses selesaikan reservasi 
  $('body').on('click', '#btn-finish-reservation', function(e) {
    Swal.fire({
      title: 'Apakah kamu yakin selesaikan reservasi ini?',
      text: "Reservasi yang diselesaikan akan berubah status menjadi 'success' dan statusnya tidak bisa dirubah lagi!",
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
            url: 'online-reservation/finish-online-reservation/' + id,
            method: 'GET',
            success: function (res) {
              ajaxStop();
              Swal.fire(
                'Berhasil!',
                res.message,
                'success'
              );
              $('#table_reservation').DataTable().ajax.reload();
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

  // Proses selesaikan pembayaran 
  $('body').on('click', '#btn-done-payment', function(e) {
    Swal.fire({
      title: 'Apakah kamu yakin selesaikan pembayaran pada reservasi ini?',
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
            url: 'online-reservation/done-payment/' + id,
            method: 'GET',
            success: function (res) {
              ajaxStop();
              Swal.fire(
                'Berhasil!',
                res.message,
                'success'
              );
              $('#table_reservation').DataTable().ajax.reload();
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
</script>