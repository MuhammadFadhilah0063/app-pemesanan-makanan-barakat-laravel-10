<script type="text/javascript">
  // Render DataTable
  $(document).ready(function () {
    $('#table_cash').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
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
        { data: 'cash' },
        { 
          data: 'total', 
          orderable: false,
          searchable: false,
          render: function (data) {
              // Menggunakan fungsi NumberFormat atau format lainnya untuk format ribuan
              return new Intl.NumberFormat('id-ID').format(data);
          } 
        },
        { 
          data: 'actions', 
          orderable: false, 
          searchable: false   
        }
      ],
      columnDefs: [
        { targets: 0, width: '1%', className: "text-lg-center align-middle text-capitalize" },
        {
          targets: 1,
          width: '30%',
          className: "align-middle text-capitalize"
        },
        {
          targets: [2, 3],
          className: "align-middle text-lg-center text-capitalize",
          width: '30%',
        },
      ]
    });
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

  // Button edit 
  $('body').on('click', '#btn-edit', function(e) {
    ajaxStart();
    let id = $(this).data('id');

    $.ajax({
      url: 'cash/' + id + '/edit',
      type: 'GET',
      success: function(response) {
        ajaxStop();
        $('#inputCash').val(response.data.cash);
        $('#inputTotal').val(response.data.total);
        $('#inputId').val(id);
        $('#exampleModalCenterTitle').html('Ubah Kas');
        $('#submit').html('Ubah');
        
        $('#modalCash').modal('show');
      },
      error: function(e) {
        ajaxStop();
        console.log('Terjadi kesalahan saat mengambil data');
      }
    });
  });

  // Button add / create
  $('body').on('click', '#btn-add', function(e) {
    // Clear data
    $('#inputCash').val('');
    $('#inputTotal').val('');
    $('#inputId').val('');

    $('#exampleModalCenterTitle').html('Tambah Kas');
    $('#submit').html('Tambah');
    
    $('#modalCash').modal('show');
  });

  // Proses update or store
  $(document).ready(function () {
    $('#formData').submit(function (e) {
      e.preventDefault();
      ajaxStart();

      if(!$('#inputId').val()) {
        // Proses store
        var url = 'cash';
        var method = 'POST';
      }else {
        // Proses update
        var id = $('#inputId').val();
        var url = 'cash/' + id;
        var method = 'PUT';
      }

      $.ajax({
        url: url,
        method: method,
        data: {
          cash: capitalizeWords($('#inputCash').val()),
          total: $('#inputTotal').val(),
        },
        success: function(response) {
          ajaxStop();
          Swal.fire({
            title: 'Berhasil',
            text: (url == 'cash' ? 'Kas baru berhasil ditambahkan!' : 'Kas berhasil diubah!'),
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Tutup',
          })
          $('#modalCash').modal('hide');
          reloadTable('#table_cash')
        },
        error: function(e) {
          console.clear();
          errors = e.responseJSON.errors;
          ajaxStop();

          if(errors.cash) {
            $('#inputCash').addClass('is-invalid');
            $('#inputCashError').removeClass('d-none');
            $('#inputCashError').html(errors.cash[0]);
          }
        }
      });
    })
  })

  // Proses Destroy 
  $('body').on('click', '#btn-delete', function(e) {
    Swal.fire({
      title: 'Apakah kamu yakin hapus ini?',
      text: "Data ini tidak bisa dikembalikan lagi!",
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
          url: 'cash/' + id,
          type: 'DELETE',
          success: function (res) {
            ajaxStop();
            Swal.fire(
              'Berhasil!',
              'Kas berhasil dihapus!',
              'success'
            );
          },
          error: function (res) { 
            ajaxStop();
            Swal.fire({
              title: 'Gagal',
              text: 'Data ini tidak boleh dihapus',
              icon: 'error',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Tutup',
            });
          }
        });

        $('#table_cash').DataTable().ajax.reload();
      }
    })
  })  

  // Fungsi mengubah setiap awal kata menjadi uppercase
  function capitalizeWords(str) {
    return str.replace(/\b\w/g, function(match) {
      return match.toUpperCase();
    });
  }
</script>