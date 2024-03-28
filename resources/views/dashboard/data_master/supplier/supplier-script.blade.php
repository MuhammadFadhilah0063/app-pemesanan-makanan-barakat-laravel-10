<script type="text/javascript">
  // Render DataTable
  $(document).ready(function () {
    $('#table_supplier').DataTable({
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
        { data: 'name'},
        { data: 'description'},
        { data: 'phone', searchable: false, },
        { data: 'address' },
        { 
          data: 'actions', 
          orderable: false, 
          searchable: false   
        }
      ],
      columnDefs: [
        { targets: 0, width: '1%', className: "text-lg-center align-middle text-capitalize" },
        { targets: 1, width: '20%', className: "align-middle text-capitalize" },
        { targets: 2, className: "align-middle text-capitalize" },
        { targets: 3, className: "text-lg-center align-middle text-capitalize" },
        { targets: 4, width: '25%', className: "align-middle text-capitalize" },
        {
          targets: 5,
          className: "align-middle text-lg-center text-capitalize",
          width: '15%',
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
      url: 'supplier/' + id + '/edit',
      type: 'GET',
      success: function(response) {
        ajaxStop();
        $('#inputName').val(response.data.name);
        $('#inputPhone').val(response.data.phone);
        $('#textareaAddress').val(response.data.address);
        $('#textareaDescription').val(response.data.description);
        $('#inputId').val(id);
        $('#exampleModalCenterTitle').html('Ubah Pemasok');
        $('#submit').html('Ubah');
        
        $('#modalSupplier').modal('show');
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
    $('#inputName').val('');
    $('#inputPhone').val('');
    $('#textareaAddress').val('');
    $('#textareaDescription').val('');
    $('#inputId').val('');

    $('#exampleModalCenterTitle').html('Tambah Pemasok');
    $('#submit').html('Tambah');
    
    $('#modalSupplier').modal('show');
  });

  // Proses update or store
  $(document).ready(function () {
    $('#formData').submit(function (e) {
      ajaxStart();
      e.preventDefault();

      if(!$('#inputId').val()) {
        // Proses store
        var url = 'supplier';
        var method = 'POST';
      }else {
        // Proses update
        var id = $('#inputId').val();
        var url = 'supplier/' + id;
        var method = 'PUT';
      }

      $.ajax({
        url: url,
        method: method,
        data: {
          name: capitalizeWords($('#inputName').val()),
          phone: $('#inputPhone').val(),
          address: $('#textareaAddress').val(),
          description: $('#textareaDescription').val(),
        },
        success: function(response) {
          ajaxStop();
          Swal.fire({
            title: 'Berhasil',
            text: (url == 'supplier' ? 'Pemasok baru berhasil ditambahkan!' : 'Pemasok berhasil diubah!'),
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Tutup',
          })
          $('#modalSupplier').modal('hide');
          reloadTable('#table_supplier')
        },
        error: function(e) {
          console.clear();
          errors = e.responseJSON.errors;
          ajaxStop();

          if(errors.name) {
            $('#inputName').addClass('is-invalid');
            $('#inputNameError').removeClass('d-none');
            $('#inputNameError').html(errors.name[0]);
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
            url: 'supplier/' + id,
            type: 'DELETE',
            success: function() {
              ajaxStop();

              Swal.fire(
                'Berhasil!',
                'Pemasok berhasil dihapus!',
                'success'
              )

              $('#table_supplier').DataTable().ajax.reload();
            },
            error: function() {
              ajaxStop();
              Swal.fire(
                'Gagal!',
                'Terjadi kesalahan!',
                'error'
              );
            }
        });
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