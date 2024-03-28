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
        $('td:eq(3)', row).css('min-width', '50px');
        $('td:eq(4)', row).css('min-width', '220px');
        $('td:eq(7)', row).css('min-width', '120px');
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
        { data: "waiting" },
        { data: 'name' },
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
          data: 'actions', 
          orderable: false, 
          searchable: false   
        }
      ],
      columnDefs: [
        { targets: 0, width: '1px', className: "text-center align-middle text-capitalize" },
        { targets: 1, width: '200px', className: "align-middle text-capitalize text-nowrap" },
        { targets: 4, className: "align-middle text-capitalize" },
        { targets: [2, 5, 6], width: '80px', className: "text-center align-middle text-capitalize text-nowrap" },
        { targets: 3, className: "text-center align-middle text-capitalize" },
        { targets: 7, className: "text-center align-middle text-capitalize text-nowrap" },
      ]
    });

    $('body').on('click', '.detail-toggle', function () {
      var id = $(this).data('id');
      detail(id);
    })
  });

  // fungsi detail reservasi pada nomor reservasi
  function detail(id) { 
    ajaxStart();
    $.ajax({
      url: 'offline-reservation/detail/' + id,
      type: 'GET',
      success: function(response) {
        ajaxStop();
        clearModal();
        $('#id_reservation').val(response.data.reservation_id);
        $('#status').val(response.data.reservation_status);
        $('#name').val(response.data.name);

        var date = new Date(response.data.reservation_date);
        var options = { day: 'numeric', month: 'long', year: 'numeric' };
        var reservation_date = date.toLocaleDateString('id-ID', options);

        $('#reservation_date').val(reservation_date);
        $('#reservation_time').val(response.data.reservation_time.substring(0, 5));

        $('#modalOfflineReservation').modal('show');
      },
      error: function(e) {
        ajaxStop();
        console.log('Terjadi kesalahan saat mengambil data');
      }
    });
  }

  // fungsi menghapus isi modal
  function clearModal() {
    $('#id_reservation').val('');
    $('#status').val('');
    $('#name').val('');
    $('#reservation_date').val('');
    $('#reservation_time').val('');
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
      url: 'offline-reservation/detail/' + id,
      type: 'GET',
      success: function(response) {
        clearModal();
        $('#id_reservation').val(response.data.reservation_id);
        $('#status').val(response.data.reservation_status);
        $('#name').val(response.data.name);

        var date = new Date(response.data.reservation_date);
        var options = { day: 'numeric', month: 'long', year: 'numeric' };
        var reservation_date = date.toLocaleDateString('id-ID', options);

        $('#reservation_date').val(reservation_date);
        $('#reservation_time').val(response.data.reservation_time.substring(0, 5));

        // Item reservation
        // template dengan foreeach
        var templateListReservationItem = '';
        var reservationItems = response.data.reservation_items;
        if(reservationItems) {
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
        $('#modalOfflineReservation').modal('show');
      },
      error: function(e) {
        ajaxStop();
        console.log('Terjadi kesalahan saat mengambil data');
      }
    });
  });

  // Proses Accept 
  $('body').on('click', '#btn-accept', function(e) {
    ajaxStart();
    var id = $(this).data('id');

    $.ajax({
        url: 'offline-reservation/checkout?reservation_id=' + id,
        method: 'GET',
        success: function (res) {
          ajaxStop();
          $('.body-checkout').html(res.html);
          $('#modalCheckout').modal('show');
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
  });

  // Proses checkout
  $('body').on('submit', '#form-reservation', function (e) {
    ajaxStart();
    e.preventDefault();

    var tables = $('input[name="check_table"]:checked');
    var tables_id = [];
    tables.each(function () {
      tables_id.push($(this).val());
    });

    if (tables_id.length != 0) {
    // Cek apakah form pada reservasi atau form pada order
    if ($(this).data('name')) {
      // form pada order
      var name = $(this).data('name');
      var phone = $(this).data('phone');
      var reservation_date = $(this).data('date');
      var reservation_time = $(this).data('time');
      var estimation_time = $(this).data('estimation');
      order_id = $(this).data('order-id');
    } else {
      // form pada reservasi
      var name = $('#input_name').val();
      var phone = $('#input_phone').val();
      var reservation_date = $('#input_reservation_date').val();
      var reservation_time = $('#input_reservation_time').val();
      var estimation_time = $('#input_select_estimation').val();
    }

    $.ajax({
      url: 'offline-reservation/accept/' + $('#reservation_id').val(),
      method: 'PUT',
      data: {
        tables_id: tables_id,
      },
      success: function () {
        ajaxStop();
        $('#modalCheckout').modal('hide');

        Swal.fire({
          title: 'Berhasil',
          text: 'Reservasi berhasil dibuat',
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Tutup',
        }).then((result) => {
          if (result.isConfirmed) {
            reloadTable('#table_reservation');
          }
        });
      },
      error: function () {
        ajaxStop();
        Swal.fire({
          title: 'Gagal',
          text: 'Terjadi kesalahan',
          icon: 'error',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Tutup',
        });
      }
    });
    } else {
      ajaxStop();
      Swal.fire({
        title: 'Gagal',
        text: 'Meja lupa dipilih!',
        icon: 'error',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Tutup',
      });
    }
  });

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
            url: 'offline-reservation/rejected/' + id,
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

  // Proses Selesaikan Reservasi 
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
            url: 'offline-reservation/finish/' + id,
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