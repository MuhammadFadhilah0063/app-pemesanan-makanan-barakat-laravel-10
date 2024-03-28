<script type="text/javascript">
  // Render DataTable
  $(document).ready(function () {
    $('#table_payment').DataTable({
      processing: true,
      serverSide: true,
      responsive: false,
      colReorder: true,
      language: language, // from config
      'createdRow': function(row, data, dataIndex){
        // $('td:eq(3)', row).css('min-width', '140px');
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
          data: 'payment_id',
          render: function (data) {
            return `<span class="detail-toggle" data-id="${data}">${data}</span>`;
          }   
        },
        { 
          data: 'total', 
          orderable: false,
          searchable: false,
        },
        { data: "payment_status" },
        { 
          data: 'updated_at', 
          searchable: false, 
          render: function (data) {
            var date = new Date(data);
            var options = { day: 'numeric', month: 'long', year: 'numeric' };
            return date.toLocaleDateString('id-ID', options);
          }
        },
        { data: "order" },
        { data: "order_status" },
        { 
          data: 'action', 
          orderable: false, 
          searchable: false   
        }
      ],
      columnDefs: [
        { targets: 0, width: '1px', className: "text-center align-middle text-capitalize" },
        { targets: 4, className: "text-center align-middle text-capitalize text-nowrap" },
        { targets: [1, 5], className: "align-middle text-capitalize text-nowrap" },
        { targets: 2, width: '80px', className: "align-middle text-capitalize text-nowrap" },
        { targets: [3, 6], width: '80px', className: "text-center align-middle text-capitalize" },
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
      url: 'payment/detail/' + id,
      type: 'GET',
      success: function(response) {
        ajaxStop();
        $('#payment_id').val(response.data.payment_id);
        $('#payment_status').val(response.data.payment_status);

        $('#payment_date').val(formatDate(response.data.updated_at));

        if(response.data.order != null) {
          $('#total').val(formatRupiah(response.data.order.total));
          $('#order_id').val(response.data.order.online_order_id);
          $('#order_status').val(response.data.order.status);
        } else {
          $('#total').val(formatRupiah(response.data.offline_order.total));
          $('#order_id').val(response.data.offline_order.offline_order_id);
          $('#order_status').val(response.data.offline_order.status);
        }
        
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

    detail(id)
  });
</script>