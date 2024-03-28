<script type="text/javascript">
  // Render DataTable
  $(document).ready(function () {
    $('#table_purchase').DataTable({
      processing: true,
      serverSide: true,
      responsive: false,
      colReorder: true,
      language: language, // from config
      'createdRow': function(row, data, dataIndex){
        $('td:eq(2)', row).css('min-width', '200px');
        $('td:eq(7)', row).css('min-width', '200px');
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
          data: 'purchase_id',
          render: function (data) {
            return `<span class="detail-toggle" data-id="${data}">${data}</span>`;
          }   
        },
        // Bahan Baku
        { data: 'raw_material.name'},
        { 
          data: 'quantity', 
          orderable: false,
          searchable: false,
          render: function (data) {
              // Menggunakan fungsi NumberFormat atau format lainnya untuk format ribuan
              return new Intl.NumberFormat('id-ID').format(data);
          }
        },
        { 
          data: 'unit_price', 
          orderable: false,
          searchable: false,
          render: function (data) {
              // Menggunakan fungsi NumberFormat atau format lainnya untuk format ribuan
              var formattedData = new Intl.NumberFormat('id-ID').format(data);
              return 'Rp. ' + formattedData;
          }
        },
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
          data: 'purchase_date', 
          searchable: false, 
          render: function (data) {
            var date = new Date(data);
            var options = { day: 'numeric', month: 'long', year: 'numeric' };
            return date.toLocaleDateString('id-ID', options);
          }
        },
        { 
          data: 'supplier.name',
          render: function (data) {
            if (data != null) {
              return data
            }else {
              return '-'
            }
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
        { targets: [1, 4, 5], className: "align-middle text-capitalize text-nowrap" },
        { targets: [2, 7], className: "align-middle text-capitalize" },
        { targets: [3, 6, 8], className: "text-center align-middle text-capitalize text-nowrap" },
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
      url: 'purchase/' + id,
      type: 'GET',
      success: function(response) {
        ajaxStop();
        $('#purchase_id').val(response.data.purchase_id);
        $('#purchase_date').val(formatDate(response.data.purchase_date));
        $('#material').val(response.data.raw_material.name);
        $('#quantity').val(formatRupiah(response.data.quantity) + ' ' + response.data.raw_material.unit);
        $('#unit_price').val(formatRupiah(response.data.unit_price));
        $('#total').val(formatRupiah(response.data.total));

        if(response.data.supplier != null) {
          $('#supplier').val(response.data.supplier.name);
        } else {
          $('#supplier').val('-');
        }

        $('#modalPurchase').modal('show');
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

  // Button create
  $('body').on('click', '#btn-add', function(e) {
    ajaxStart();
    $.ajax({
        url: 'purchase/create',
        method: 'GET',
        success: function (res) {
          ajaxStop();
          $('.body-add').html(res.html);
          $('#modalAddTitle').text('Tambah Pembelian Bahan');
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
  $('body').on('submit', '.form-purchase', function(e) {
    ajaxStart();
    e.preventDefault();
    var total = $('[name="total"]').val();
    
    $.ajax({
      url: 'purchase',
      method: 'POST',
      data: {
        purchase_date: $('[name="purchase_date"]').val(),
        quantity: $('[name="quantity"]').val(),
        unit_price: $('[name="unit_price"]').val(),
        total: parseInt(total.replace(/\D/g, '')),
        raw_material_id: $('#material_id').val(),
        supplier_id: $('#supplier_id').val(),
      },
      success: function (res) {
        ajaxStop();
        $('#modalAdd').modal('hide');
        $('#table_purchase').DataTable().ajax.reload();
        Swal.fire(
          'Berhasil!',
          'Berhasil menambahkan pembelian bahan',
          'success'
        );
      },
      error: function (err) {
        ajaxStop();
        Swal.fire(
          'Gagal!',
          'Saldo kas tidak cukup',
          'error'
        )
      }
    });
  });
 
  // Button edit
  $('body').on('click', '#btn-edit', function(e) {
    ajaxStart();
    var id = $(this).data('id');

    $.ajax({
      url: 'purchase/' + id + '/edit',
      method: 'GET',
      success: function (res) {
        ajaxStop();
        $('.body-add').html(res.html);
        $('#modalAddTitle').text('Ubah Pembelian Bahan');
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

  // Proses update
  $('body').on('submit', '.form-purchase-edit', function(e) {
    ajaxStart();
    e.preventDefault();
    var id = $('[name="purchase_id"]').val();
    var qty = $('[name="quantity"]').val();
    var price = $('[name="unit_price"]').val();
    var total = $('[name="total"]').val();

    $.ajax({
      url: 'purchase/' + id,
      method: 'PUT',
      data: {
        purchase_date: $('[name="purchase_date"]').val(),
        quantity: parseInt(qty.replace(/\D/g, '')),
        unit_price: parseInt(price.replace(/\D/g, '')),
        total: parseInt(total.replace(/\D/g, '')),
        raw_material_id: $('#material_id').val(),
        supplier_id: $('#supplier_id').val(),
      },
      success: function (res) {
        ajaxStop();
        $('#modalAdd').modal('hide');
        $('#table_purchase').DataTable().ajax.reload();
        Swal.fire(
          'Berhasil!',
          'Berhasil mengubah pembelian bahan',
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

  $('body').on('change', '[name="quantity"]', setTotal);
  $('body').on('change', '[name="unit_price"]', setTotal);

  function setTotal() {
    var qty = $('[name="quantity"]').val();
    var price = $('[name="unit_price"]').val();

    if(qty != '' && price != '') {
      var elTotal = $('[name="total"]');
      elTotal.val(formatRupiah( parseInt(qty.replace(/\D/g, '')) * parseInt(price.replace(/\D/g, '')) ));
    }
  }

   // Delete
   $('body').on('click', '#btn-delete', function () {
    Swal.fire({
      title: 'Apakah kamu yakin menghapus data pembelian bahan ini?',
      text: "Data pembelian bahan ini tidak bisa dikembalikan lagi!",
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
            url: 'purchase/' + id,
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

        $('#table_purchase').DataTable().ajax.reload();
      }
    })
  })
</script>