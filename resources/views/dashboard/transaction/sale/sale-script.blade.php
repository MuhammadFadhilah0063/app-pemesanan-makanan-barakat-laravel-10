<script type="text/javascript">
  // Render DataTable
  $(document).ready(function () {
    $('#table_sale').DataTable({
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
          data: 'sale_id',
          render: function (data) {
            return `<span class="detail-toggle" data-id="${data}">${data}</span>`;
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
          data: 'sale_date', 
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
        { targets: [1, 2], className: "align-middle text-capitalize text-nowrap" },
        { targets: [3, 4], className: "text-center align-middle text-capitalize text-nowrap" },
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
      url: 'sale/' + id,
      type: 'GET',
      success: function(response) {
        $('#sale_id').val(response.data.sale_id);
        $('#total').val(formatRupiah(response.data.total));
        $('#sale_date').val(formatDate(response.data.sale_date));
        $('#total').val((response.data.total).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, "."));

        // Item order
        // template dengan foreeach
        var listItem = '';
        var saleItems = response.data.sale_items;
        saleItems.forEach((item, index) => {
          var price = item.price.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
          var quantity = item.quantity.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
          var subtotal = (item.price * item.quantity).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
          
          if(index == 0) {
            listItem = 
            `<div class="row">
              <div class="col">
                <h6>${item.selling.name}</h6>
                <span>${quantity}x </span><span>${price}</span>
              </div>
              <div class="col">
                <div class="float-right">
                  <h6>Subtotal</h6>
                  <span>Rp. ${subtotal}</span>
                </div>
              </div>
            </div>
            <hr class="mt-1">
            `
          }else {
            listItem += 
            `<div class="row">
              <div class="col">
                <h6>${item.selling.name}</h6>
                <span>${quantity}x </span><span>${price}</span>
              </div>
              <div class="col">
                <div class="float-right">
                  <h6>Subtotal</h6>
                  <span>Rp. ${subtotal}</span>
                </div>
              </div>
            </div>
            <hr class="mt-1">
            `
          }
        });

        ajaxStop();
        $('#items').html(listItem);
        
        $('#modal').modal('show');
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
    let id = $(this).data('id');

    detail(id);
  });

  // Proses Edit 
  $('body').on('click', '#btn-edit', function(e) {
    ajaxStart();
    var id = $(this).data('id');
    
    $.ajax({
        url: 'sale/' + id + '/edit',
        method: 'GET',
        success: function (res) {
          ajaxStop();
          $('.body-add').html(res.html);
          $('#modalAddTitle').text('Ubah Penjualan');
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
  
    $('#table_sale').DataTable().ajax.reload();
  })  

  // Proses Create 
  $('body').on('click', '#btn-add', function(e) {
    $.ajax({
        url: 'sale/create',
        method: 'GET',
        success: function (res) {
          $('.body-add').html(res.html);
          $('#modalAddTitle').text('Tambah Penjualan');
          $('#modalAdd').modal('show');
        },
        error: function (err) {
          Swal.fire(
            'Gagal!',
            'Terjadi Kesalahan',
            'error'
          )
        }
    });
  });

  // Proses Tambah Item 
  $('body').on('click', '#btn_select_item', addItem);

  // Fungsi tambah item
  function addItem() {
    ajaxStart();
    $.ajax({
      url: 'sale/add-item',
      method: 'POST',
      data: {
        'selling_id': $('#selectItem').val(),
      },
      success: function (res) {
        ajaxStop();
        var itemsContainer = document.getElementById('items_add');
        var sellingNames = $('.selling-name');
        if(sellingNames.length == 0) {
          itemsContainer.innerHTML += res.html;
          $('input#qty').each(function() {
            $(this).on('change', function() {
              var newValue = $(this).val();
              $(this).attr('value', newValue);
              total();
            });
          }); 
          $('input#price').each(function() {
            $(this).on('change', function() {
              var newValue = $(this).val();
              $(this).attr('value', newValue);
              total();
            });
          }); 
          total();
        } else {
          var result = true;
          for (let index = 0; index < sellingNames.length; index++) {
            const name = sellingNames[index].innerHTML;
            if(name == res.selling_name) {
              result = false;
              $('body').off('click', '#btn_select_item');
              Swal.fire(
                'Gagal!',
                'Item sudah ada',
                'error'
              ).then((confirm) => {
                if (confirm) {
                  $('body').on('click', '#btn_select_item', addItem);
                } 
              });
            }
          }
          if(result) {
            itemsContainer.innerHTML += res.html;
            $('input#qty').each(function() {
            $(this).on('change', function() {
              var newValue = $(this).val();
              $(this).attr('value', newValue);
              total();  
              });
            });    
            $('input#price').each(function() {
              $(this).on('change', function() {
                var newValue = $(this).val();
                $(this).attr('value', newValue);
                total();
              });
            });  
            total();
          }
        }          
      },
      error: function () { ajaxStop(); }
    });
  }
    
  // Proses Store
  $('body').on('submit', '.form-sale', function(e) {
    ajaxStart();
    e.preventDefault();
    var el = $('.row-item');
    var items = [];
    
    if(el.length != 0) {
      for (let index = 0; index < el.length; index++) {
      items.push({
        selling_id: el[index].getAttribute('data-selling-id'),
        quantity: $(el[index]).find('#qty').val(),
        price: $(el[index]).find('#price').val(),
      });
      }
    }
    if(items.length != 0 ) {
      var total = ($('#sale_total').text()).replace(/[^\d]/g, "");
      var sale_id = $('.sale-id').val();

      $.ajax({
        url: 'sale',
        method: 'POST',
        data: {
          sale_date: $('#date_sale').val(),
          sale_items: items,
          total: parseInt(total),
        },
        success: function (res) {
          ajaxStop();
          $('#modalAdd').modal('hide');
          $('#table_sale').DataTable().ajax.reload();
          Swal.fire(
            'Berhasil!',
            'Berhasil menambahkan penjualan',
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
    }else {
      ajaxStop();
      Swal.fire(
        'Gagal!',
        'Maaf item penjualan belum anda pilih',
        'error'
      )
    }
    
  });

  // Proses update
  $('body').on('submit', '.form-sale-edit', function(e) {
    ajaxStart();
    e.preventDefault();
    var el = $('.row-item');
    var items = [];
    
    if(el.length != 0) {
      for (let index = 0; index < el.length; index++) {
      items.push({
        selling_id: el[index].getAttribute('data-selling-id'),
        quantity: $(el[index]).find('#qty').val(),
        price: $(el[index]).find('#price').val(),
      });
      }
    }
    if(items.length != 0 ) {
      var total = ($('#sale_total').text()).replace(/[^\d]/g, "");
      var sale_id = $('.sale-id').val();

      $.ajax({
        url: 'sale/' + sale_id,
        method: 'PUT',
        data: {
          sale_date: $('#date_sale').val(),
          sale_items: items,
          total: parseInt(total),
        },
        success: function (res) {
          ajaxStop();
          $('#modalAdd').modal('hide');
          $('#table_sale').DataTable().ajax.reload();
          Swal.fire(
            'Berhasil!',
            'Berhasil mengubah penjualan',
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
    }else {
      ajaxStop();
      Swal.fire(
        'Gagal!',
        'Maaf item penjualan belum anda pilih',
        'error'
      )
    }
  });

  $('body').on('hidden.bs.modal', '#modalAdd', function(e) { 
    var itemsContainer = document.getElementById('items_add');
    itemsContainer.innerHTML = '';
  });

  function total() {
    $elTotal = $('#sale_total');
    var el = $('.row-item');
    var subtotal = [];
    var total = 0;
      
    if(el.length != 0) {
      for (let index = 0; index < el.length; index++) {
        var result = parseInt($(el[index]).find('#qty').val()) * parseInt($(el[index]).find('#price').val())
        subtotal.push(result);
      }

      total = subtotal.reduce(function(acc, currentValue) {
        return acc + currentValue;
      }, 0);
    }

    $elTotal.text('Rp. ' + formatRupiah(total));
  }

  // Delete
  $('body').on('click', '#btn-delete', function () {
    Swal.fire({
      title: 'Apakah kamu yakin menghapus data penjualan ini?',
      text: "Data penjualan ini tidak bisa dikembalikan lagi!",
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
            url: 'sale/' + id,
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

        $('#table_sale').DataTable().ajax.reload();
      }
    })
  })
</script>