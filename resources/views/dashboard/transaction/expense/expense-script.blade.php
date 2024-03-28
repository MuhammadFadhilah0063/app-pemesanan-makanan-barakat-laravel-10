<script type="text/javascript">
  // Render DataTable
  $(document).ready(function () {
    $('#table_expense').DataTable({
      processing: true,
      serverSide: true,
      responsive: false,
      colReorder: true,
      language: language, // from config
      'createdRow': function(row, data, dataIndex){
        $('td:eq(2)', row).css('min-width', '230px');
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
          data: 'expense_id',
          render: function (data) {
            return `<span class="detail-toggle" data-id="${data}">${data}</span>`;
          }   
        },
        { data: 'description'},
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
          data: 'expense_date', 
          searchable: false, 
          render: function (data) {
            var date = new Date(data);
            var options = { day: 'numeric', month: 'long', year: 'numeric' };
            return date.toLocaleDateString('id-ID', options);
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
        { targets: [1, 3], className: "align-middle text-capitalize text-nowrap" },
        { targets: 2, className: "align-middle text-capitalize" },
        { targets: [4, 5], className: "text-center align-middle text-capitalize text-nowrap" },
      ]
    });

    $('body').on('click', '.detail-toggle', function () {
      var id = $(this).data('id');
      detail(id);
    })
  });

  function detail(id) { 
    ajaxStart();
    $.ajax({
      url: 'expense/' + id,
      type: 'GET',
      success: function(response) {
        ajaxStop();
        $('#expense_id').val(response.data.expense_id);
        $('#expense_date').val(formatDate(response.data.expense_date));
        $('#total').val(formatRupiah(response.data.total));
        $('#description').val(response.data.description);

        $('#modalExpense').modal('show');
      },
      error: function(e) {
        ajaxStop();
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
    detail($(this).data('id'))
  });

  // Button edit
  $('body').on('click', '#btn-edit', function(e) {
    ajaxStart();
    var id = $(this).data('id');

    $.ajax({
      url: 'expense/' + id + '/edit',
      method: 'GET',
      success: function (res) {
        ajaxStop();
        $('.body-add').html(res.html);
        $('#modalAddTitle').text('Ubah Pengeluaran');
        $('#modalAdd').modal('show');
      },
      error: function (err) {
        ajaxStop();
        Swal.fire(
          'Gagal!',
          'Terjadi Kesalahan',
          'error'
        )
      }
    });
  });

  // Button create
  $('body').on('click', '#btn-add', function(e) {
    ajaxStart();
    $.ajax({
        url: 'expense/create',
        method: 'GET',
        success: function (res) {
          ajaxStop();
          $('.body-add').html(res.html);
          $('#modalAddTitle').text('Tambah Pengeluaran');
          $('#modalAdd').modal('show');
        },
        error: function (err) {
          ajaxStop();
          Swal.fire(
            'Gagal!',
            'Terjadi Kesalahan',
            'error'
          )
        }
    });
  });

  // Proses Store
  $('body').on('submit', '.form-expense', function(e) {
    ajaxStart();
    e.preventDefault();
    
    $.ajax({
      url: 'expense',
      method: 'POST',
      data: {
        expense_date: $('[name="expense_date"]').val(),
        description: $('#description_area').val(),
        total: $('[name="total"]').val(),
      },
      success: function (res) {
        ajaxStop();
        $('#modalAdd').modal('hide');
        $('#table_expense').DataTable().ajax.reload();
        Swal.fire(
          'Berhasil!',
          'Berhasil menambahkan pengeluaran',
          'success'
        );
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

  // Proses update
  $('body').on('submit', '.form-expense-edit', function(e) {
    ajaxStart();
    e.preventDefault();
    var id = $('[name="expense_id"]').val();

    $.ajax({
      url: 'expense/' + id,
      method: 'PUT',
      data: {
        expense_date: $('[name="expense_date"]').val(),
        description: $('#description_area').val(),
        total: $('[name="total"]').val(),
      },
      success: function (res) {
        ajaxStop();
        $('#modalAdd').modal('hide');
        $('#table_expense').DataTable().ajax.reload();
        Swal.fire(
          'Berhasil!',
          'Berhasil mengubah pengeluaran',
          'success'
        );
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

  // Delete
  $('body').on('click', '#btn-delete', function () {
    Swal.fire({
      title: 'Apakah kamu yakin menghapus data pengeluaran ini?',
      text: "Data pengeluaran ini tidak bisa dikembalikan lagi!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.isConfirmed) {
        ajaxStart();
        var id = $(this).data('id');

        $.ajax({
            url: 'expense/' + id,
            method: 'DELETE',
            success: function (res) {
              ajaxStop();
              Swal.fire(
                'Berhasil!',
                res.message,
                'success'
              )
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

        $('#table_expense').DataTable().ajax.reload();
      }
    })
  })
</script>