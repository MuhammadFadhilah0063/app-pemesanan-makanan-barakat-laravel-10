<script>
  // Form pilih
  $('body').on('submit', '#form_select', function (e) {
    ajaxStart();
    e.preventDefault();

    var month = '';
    var year = $('#report_year').val();
    var url = '{{ url()->current() }}';

    if($('#report_month').val() != '') {
      month = $('#report_month').val();
    }

    if($('#report_year').val() != '') {
      year = $('#report_year').val();
    }

    if(month != '' && year != '') {
      url += '?month=' + month + '&year=' + year
    }else if (year != '') {
      url += '?year=' + year
    }

    // Hapus instansiasi datatable
    var table = $('#table_order').DataTable();
    table.destroy();

    // Url

    // Render datatable
    $('#table_order').DataTable({
      processing: true,
      serverSide: true,
      responsive: false,
      colReorder: true,
      language: language, // from config
      ajax: {
        'url': url,
      },
      'createdRow': function(row, data, dataIndex){
        $('td:eq(2)', row).css('min-width', '180px');
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
        },
        { data: 'name' },
        { data: 'pick_up_date', searchable: false, 
          render: function (data) {
            var date = new Date(data);
            var options = { day: 'numeric', month: 'long', year: 'numeric' };
            return date.toLocaleDateString('id-ID', options);
          }
        },
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
      ],
      columnDefs: [
        { targets: 0, width: '1px', className: "text-nowrap text-center align-middle text-capitalize" },
        { targets: [1, 5], className: "text-nowrap align-middle text-capitalize" },
        { targets: [3, 4], className: "text-nowrap align-middle text-center text-capitalize" },
      ]
    });

    ajaxStop();
    // Tampilkan tabel
    if ($('.row-table').hasClass('d-none')) {
      $('.row-table').removeClass('d-none');
    } 

    // Ubah title
    if($('#report_year').val() != '' && $('#report_month').val() != '') {
      $('#row_table_title').text(`Data Pesanan online Pada Bulan ${getMonthName($('#report_month').val())} Tahun ${$('#report_year').val()}`);
    }else if($('#report_year').val() != '') {
      $('#row_table_title').text(`Data Pesanan online Pada Tahun ${$('#report_year').val()}`);
    }else {
      $('#row_table_title').text('Data Semua Pesanan online');
    }
  })

  // Button cetak
  $('body').on('click', '.btn-print', function (e) {
    var month = $('#report_month').val();
    var year = $('#report_year').val();

    var newURL = 'online-order/export?year=' + year + '&month=' + month;
    window.open(newURL, '_blank');
  });
</script>