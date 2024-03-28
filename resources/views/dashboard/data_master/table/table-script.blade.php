<script type="text/javascript">
  // Render DataTable
  $(document).ready(function () {
    $('#table_table').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      colReorder: true,
      language: language, // from config
      ajax: {
        'url': '{{ url()->current() }}',
        'data': function (data) { 
          data.ready = $('#status').val();
        }  
      },
      columns: [
        { 
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          orderable: false,
          searchable: false,
          render: function (data) {
              // Menggunakan fungsi NumberFormat atau format lainnya untuk format ribuan
              return new Intl.NumberFormat('id-ID').format(data);
          }
        },
        { 
          data: 'id',
        },
        { 
          data: 'image',
          orderable: false, 
          searchable: false 
        },
        { 
          data: 'actions', 
          name: "actions",
          orderable: false, 
          searchable: false 
        },
      ],
      columnDefs: [
        { targets: 0, width: '1%', className: "text-lg-center align-middle text-capitalize" },
        {
          targets: [1],
          className: "text-center align-middle text-capitalize"
        },
        {
          targets: [2],
          className: "text-left text-sm-center align-middle text-capitalize"
        },
        {
          targets: 3,
          width: '20%',
          className: "text-lg-center align-middle text-capitalize"
        },
      ]
    });

    // Filter status
    $('#status').change(function () {
      reloadTable('#table_table');
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
      url: 'table/' + id + '/edit',
      type: 'GET',
      success: function(response) {
        ajaxStop();
        if(response.data.description) {
          $('#textareaDescription').val(response.data.description);
        }
        $('#inputId').val(id);

        // image
        // Ekstrak nama file dari URL
        var imageUrl = response.data.image;
        var fileName = imageUrl.substring(imageUrl.lastIndexOf('/') + 1);
        $('.custom-file-label').addClass('selected').html(fileName);
        $('#previewImage').attr('src', imageUrl);

        $('#exampleModalCenterTitle').html('Ubah Meja');
        $('#submit').html('Ubah');
        
        $('#modalTable').modal('show');
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
    $('#inputId').val('');
    $('#textareaDescription').val('');

    // Kosongkan file input
    var fileInput = $('#inputFile');
    fileInput.val(null);
    fileInput.next('.custom-file-label').html('Pilih file');

    // Set kembali ke image default
    $('#previewImage').attr('src', "{{ asset('storage/image/app/img.png')}}").show();

    $('#exampleModalCenterTitle').html('Tambah Meja');
    $('#submit').html('Tambah');
    
    $('#modalTable').modal('show');
  });

  // Proses update or store
  $(document).ready(function () {
    $('#formData').submit(function (e) {
      ajaxStart();
      e.preventDefault();
      clearError();

      var description = $('#textareaDescription').val();

      // File gambar
      var fileInput = document.getElementById('inputFile');
      var image = fileInput.files[0];

      // FormData
      var formData = new FormData();
      if(image != undefined) {
        formData.append('image', image);
      }
      formData.append('description', description);

      if(!$('#inputId').val()) {
        // Proses store
        var url = 'table';
      }else {
        // Proses update
        var id = $('#inputId').val();
        var url = 'table/' + id;
        formData.append('_method', 'PUT');
      }

      $.ajax({
        url: url,
        processData: false,
        contentType: false,
        method: 'POST',
        data: formData,
        enctype: 'multipart/form-data',
        success: function(response) {
          ajaxStop();
          Swal.fire({
            title: 'Berhasil',
            text: (url == 'table' ? 'Meja baru berhasil ditambahkan!' : 'Meja berhasil diubah!'),
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Tutup',
          })
          $('#modalTable').modal('hide');
          reloadTable('#table_table')
        },
        error: function(e) {
          ajaxStop();
          console.clear();
          errors = e.responseJSON.errors;

          // Menampilkan error
          if(errors.image) {
            $('#inputFile').addClass('is-invalid');
            $('#inputFileError').removeClass('d-none');

            // template dengan foreeach
            var errorsImage = errors.image;
            var html;
            errorsImage.forEach(function(item, index) {
              if(index == 0) {
                html = `<span class="d-block mb-1">${item}</span>`;
              }else {
                html += `<span class="d-block mb-1">${item}</span>`;
              }
            });
            
            $('#inputFileError').html(html);
          }
        }
      });
    })
  })

  // Clear validasi error ketika modal ditutup
  $('#modalTable').on('hide.bs.modal', function () {
    clearError();
  })

  // fungsi clear error
  function clearError() {
    if($('#inputFile')) {
      $('#inputFile').removeClass('is-invalid');
      $('#inputFileError').addClass('d-none');
      $('#inputFileError').html('');
    }
  }

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
            url: 'table/' + id,
            type: 'DELETE',
            success: function() {
              ajaxStop();

              Swal.fire(
                'Berhasil!',
                'Meja berhasil dihapus!',
                'success'
              )

              $('#table_table').DataTable().ajax.reload();
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

  // Input file
  $(document).ready(function() {
    $('#inputFile').on('change', function(event) {
      var fileName = $(this).val().split('\\').pop();
      $(this).next('.custom-file-label').addClass('selected').html(fileName);
    });
  });

  // Image prewiew
  $('#inputFile').on('change', function() {
    var file = this.files[0];
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#previewImage').attr('src', e.target.result).show();
    }

    reader.readAsDataURL(file);
  });

</script>