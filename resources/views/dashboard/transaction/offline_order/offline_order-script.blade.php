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
          data: 'offline_order_id',
          render: function (data) {
            return `<span class="detail-toggle" data-id="${data}">${data}</span>`;
          }   
        },
        { data: 'name' },
        { data: "order_status" },
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
        { 
          data: 'payment_status',
          searchable: false, 
        },
        { 
          data: 'actions', 
          orderable: false, 
          searchable: false   
        }
      ],
      columnDefs: [
        { targets: 0, width: '1px', className: "text-center align-middle text-capitalize" },
        { targets: 1, width: '200px', className: "align-middle text-capitalize text-nowrap" },
        { targets: 2, width: '300px', className: "align-middle text-capitalize text-nowrap" },
        { targets: 3, width: '80px', className: "text-center align-middle text-capitalize" },
        { targets: 5, width: '80px', className: "px-5 text-center align-middle text-capitalize" },
        { targets: [4, 6], width: '200px', className: "text-center align-middle text-capitalize text-nowrap" },
      ]
    });

    $('body').on('click', '.detail-toggle', function () {
      var id = $(this).data('id');
      detail(id);
    })
  });

  // Fungsi detail pada nomor pesanan
  function detail(id) { 
    ajaxStart();
    $.ajax({
      url: 'offline-order/detail/' + id,
      type: 'GET',
      success: function(response) {
        $('#id_pesanan').val(response.data.offline_order_id);
        $('#status').val(response.data.status);
        $('#name').val(response.data.name);
        $('#total').val(response.data.total);
        if(response.data.payment != null) {
          $('#payment_status').val(response.data.payment.payment_status);
        } else {
          $('#payment_status').val('Belum Bayar');
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
                  <h6>${item.food.name}</h6>
                  <span>${quantity}x </span><span>${price}</span>
                </div>
            </div>
            <hr class="mt-1">
            `
          }else {
            templateListOrderItem += 
            `<div class="row">
              <div class="col">
                <h6>${item.food.name}</h6>
                <span>${quantity}x </span><span>${price}</span>
              </div>
            </div>
            <hr class="mt-1">
            `
          }
        });

        ajaxStop();
        $('#card_order_items').html(templateListOrderItem);
        
        $('#modalOfflineOrder').modal('show');
      },
      error: function(e) {
        console.log('Terjadi kesalahan saat mengambil data');
      }
    });
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
      url: 'offline-order/detail/' + id,
      type: 'GET',
      success: function(response) {
        $('#id_pesanan').val(response.data.offline_order_id);
        $('#status').val(response.data.status);
        $('#name').val(response.data.name);
        $('#total').val(response.data.total);
        if(response.data.payment != null) {
          $('#payment_status').val(response.data.payment.payment_status);
        } else {
          $('#payment_status').val('Menunggu pembayaran');
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
                  <h6>${item.food.name}</h6>
                  <span>${quantity}x </span><span>${price}</span>
                </div>
            </div>
            <hr class="mt-1">
            `
          }else {
            templateListOrderItem += 
            `<div class="row">
              <div class="col">
                <h6>${item.food.name}</h6>
                <span>${quantity}x </span><span>${price}</span>
              </div>
            </div>
            <hr class="mt-1">
            `
          }
        });

        ajaxStop();
        $('#card_order_items').html(templateListOrderItem);
        
        $('#modalOfflineOrder').modal('show');
      },
      error: function(e) {
        console.log('Terjadi kesalahan saat mengambil data');
      }
    });
  });

  // Proses Rejected atau batalkan pesanan
  $('body').on('click', '#btn-rejected', function(e) {
    Swal.fire({
      title: 'Apakah kamu yakin membatalkan pesanan ini?',
      text: "Pesanan yang dibatalkan akan berubah status menjadi 'failed' dan statusnya tidak bisa dirubah lagi!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Batalkan Pesanan',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.isConfirmed) {
        ajaxStart();
        var id = $(this).data('id');
        $.ajax({
            url: 'offline-order/rejected/' + id,
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

  // Proses Close Order In Dashboard Admin 
  $('body').on('click', '#btn-close-order', function(e) {
    Swal.fire({
      title: 'Apakah kamu yakin menutup pesanan ini?',
      text: "Pesanan yang ditutup akan berubah status menjadi 'success' dan statusnya tidak bisa dirubah lagi!",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Tutup Pesanan',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.isConfirmed) {
        ajaxStart()
        var id = $(this).data('id');
        $.ajax({
            url: 'offline-order/close-order-in-dashboard-admin/' + id,
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

  // Proses Terima Pembayaran In Dashboard Admin Untuk Pembayaran Tunai
  $('body').on('click', '#btn-payment-accept', function(e) {
    Swal.fire({
      title: 'Apakah kamu yakin menerima pembayaran pesanan ini?',
      text: "Pesanan yang diterima akan berubah status pembayarannya menjadi 'success' dan statusnya tidak bisa dirubah lagi!",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Terima Pembayaran',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.isConfirmed) {
        ajaxStart();
        var id = $(this).data('id');
        $.ajax({
            url: 'offline-order/accept-payment/' + id,
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
  
  // Action cetak bukti pembayaran offline start
  $('body').on('click', '#btn-payment', function (e) {
    var order_id = $(this).data('id');

    var newURL = myApp + '/offline/order/payment/' + order_id.toLowerCase();
    window.open(newURL, '_blank');
  });
  // Action cetak bukti pembayaran end
</script>